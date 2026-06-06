<?php

namespace App\Livewire\Dashboard;

use App\Models\Report;
use App\Models\Shipment;
use App\Models\Truck;
use Carbon\Carbon;
use Livewire\Component;

#[\Livewire\Attributes\Title('Dashboard')]
class Index extends Component
{
    // ── Shipment KPI ──────────────────────────────────────────────
    public int $totalShipments;
    public string $shipmentPct;
    public int $shipmentProgress;
    public array $chartData;
    public array $chartLabels;

    // ── Truck KPI ─────────────────────────────────────────────────
    public int $truckInDelivery;
    public int $totalTrucks;
    public string $truckUtility;
    public array $truckBars;
    public int $truckAvailable;
    public array $fleetChartData;

    // ── Report KPI ────────────────────────────────────────────────
    public int $totalReport;
    public int $reportPct;
    public int $reportNote;

    // ── Revenue KPI ───────────────────────────────────────────────
    public int $revenue;
    public int $revenueTarget;
    public float $revenueGrowth;

    // ── Recent Activity ───────────────────────────────────────────
    public $recentShipments;

    // ─────────────────────────────────────────────────────────────

    public function mount(): void
    {
        $this->loadShipmentMetrics();
        $this->loadTruckMetrics();
        $this->loadReportMetrics();
        $this->loadRevenueMetrics();
        $this->loadRecentShipments();
    }

    // ── Private Loaders ───────────────────────────────────────────

    private function loadShipmentMetrics(): void
    {
        $currentMonth = Shipment::whereMonth('created_at', now()->month)->count();
        $lastMonth    = Shipment::whereMonth('created_at', now()->subMonth()->month)->count();

        $pct = $lastMonth > 0
            ? round((($currentMonth - $lastMonth) / $lastMonth) * 100)
            : 0;

        $this->totalShipments   = $currentMonth;
        $this->shipmentPct      = ($pct >= 0 ? '+' : '') . $pct . '%';
        $this->shipmentProgress = $lastMonth > 0
            ? min(100, (int) round(($currentMonth / $lastMonth) * 100))
            : 0;

        $days = collect(range(6, 0))->map(fn ($i) => now()->subDays($i));

        $this->chartLabels = $days->map(fn ($d) => $d->translatedFormat('D'))->toArray();

        $this->chartData = $days->map(
            fn ($d) => Shipment::whereDate('created_at', $d->toDateString())
                ->where('status', 'selesai')
                ->count()
        )->toArray();
    }

    private function loadTruckMetrics(): void
    {
        $total      = Truck::count();
        $inDelivery = Truck::where('current_status', 'dalam pengiriman')->count();
        $available  = Truck::where('current_status', 'tidak dalam pengiriman')->count();

        $this->totalTrucks     = $total;
        $this->truckInDelivery = $inDelivery;
        $this->truckAvailable  = $available;
        $this->truckUtility    = $total > 0
            ? round(($inDelivery / $total) * 100) . '%'
            : '0%';

        $rawBars = Truck::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('current_status', 'dalam pengiriman')
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total')
            ->map(fn ($v) => $total > 0 ? min(100, (int) round(($v / $total) * 100)) : 0)
            ->toArray();

        $this->truckBars = array_pad($rawBars, -7, 0);

        $this->fleetChartData = [$inDelivery, $available];
    }

    private function loadReportMetrics(): void
    {
        $todayCount    = Report::whereDate('created_at', today())->count();
        $recentCount   = Report::where('created_at', '>=', now()->subDays(7))->count();

        $this->totalReport = $todayCount;
        $this->reportPct   = $todayCount > 0
            ? (int) round(($recentCount / $todayCount) * 100)
            : 0;
        $this->reportNote  = Report::where('created_at', '>=', now()->subDay())->count();
    }

    private function loadRevenueMetrics(): void
    {
        $current = (int) Shipment::where('status', 'selesai')
            ->whereYear('completed_at', now()->year)
            ->sum('delivery_order_price');

        $previous = (int) Shipment::where('status', 'selesai')
            ->whereYear('completed_at', now()->subYear()->year)
            ->whereMonth('completed_at', '<=', now()->month)
            ->sum('delivery_order_price');

        $this->revenue       = $current;
        $this->revenueTarget = 300_000_000;
        $this->revenueGrowth = $previous > 0
            ? round((($current - $previous) / $previous) * 100, 2)
            : 0.0;
    }

    private function loadRecentShipments(): void
    {
        $this->recentShipments = Shipment::with('truck.drivers')
            ->latest('created_at')
            ->limit(4)
            ->get();
    }

    // ── Helpers ───────────────────────────────────────────────────

    public function formatElapsedTime(string $timestamp): string
    {
        $diff  = Carbon::parse($timestamp)->diff(now());
        $parts = [];

        if ($diff->d > 0) {
            $parts[] = $diff->d . ' Hari';
        }
        if ($diff->h > 0) {
            $parts[] = $diff->h . ' Jam';
        }
        if ($diff->i > 0) {
            $parts[] = $diff->i . ' Menit';
        }

        return $parts ? implode(' ', $parts) . ' lalu' : 'Baru saja';
    }

    // ── Render ────────────────────────────────────────────────────

    public function render()
    {
        return view('livewire.dashboard.index', [
            'lastMonth' => Shipment::whereMonth('created_at', now()->subMonth()->month)->count(),
        ]);
    }
}