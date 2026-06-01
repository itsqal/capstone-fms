<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Shipment;
use App\Models\Truck;
use App\Models\Report;

#[\Livewire\Attributes\Title('Dashboard')]
class Index extends Component
{
    public int $totalShipments;
    public $shipmentPct;
    public int $shipmentProgress;
    public $chartData;
    public $chartLabels;

    public int $truckInDelivery;
    public int $totalTrucks;
    public $truckUtilitiy;
    public array $truckBars;

    public $fleetChartData;
    public $truckAvailable;

    public int $totalReport;
    public int $reportPct;
    public int $reportNote;

    public int $revenue;
    public int $revenueTarget;
    public float $revenueGrowth;


    public function mount(): void
    {
        // Shipment Data
        $this->totalShipments   = Shipment::whereMonth('created_at', now()->month())->count();
        $lastMonth               = Shipment::whereMonth('created_at', now()->subMonth()->month)->count();
        $pct                     = $lastMonth > 0 ? round((($this->totalShipments - $lastMonth) / $lastMonth) * 100) : 0;
        $this->shipmentPct     = ($pct >= 0 ? '+' : '') . $pct . '%';
        $this->shipmentProgress = min(100, round(($this->totalShipments / $lastMonth) * 100));

        $days = collect(range(6, 0))->map(fn ($i) => now()->subDays($i));

        $this->chartLabels = $days->map(fn ($d) => $d->translatedFormat('D'))->toArray();

        $this->chartData = $days->map(fn ($d) =>
            Shipment::whereDate('created_at', $d->toDateString())
                    ->where('status', 'selesai')
                    ->count()
        )->toArray();

        $this->totalTrucks   = Truck::count();
        $this->truckInDelivery = Truck::where('current_status', 'dalam pengiriman')->count();
        $utilPct           = $this->totalTrucks > 0 ? round(($this->truckInDelivery / $this->totalTrucks) * 100) : 0;
        $this->truckUtility = $utilPct . '%';

        $this->truckBars = Truck::selectRaw('DATE(created_at) as date, COUNT(*) as total')
        ->where('current_status', 'dalam pengiriman')
        ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('total')
        ->map(fn ($v) => min(100, round(($v / $this->totalTrucks) * 100)))
        ->toArray();

        $this->truckAvailable       = Truck::where('current_status', 'tidak dalam pengiriman')->count();
        $this->fleetChartData       = [
            $this->truckInDelivery,
            $this->truckAvailable,

        ];

        // Pad to always have 7 entries if some days have no data
        $this->truckBars = array_pad($this->truckBars, -7, 0);

        $this->totalReport = Report::where('created_at', now()->today())->count();
        $recentReports = Report::where('created_at', '>=', now()->subDays(7))->count();
        $this->reportPct = $this->totalReport > 0
            ? (int) round(($recentReports / $this->totalReport) * 100)
            : 0;
        $this->reportNote = Report::where('created_at', '>=', now()->subDay())->count();

        $this->revenue = (int) Shipment::where('status', 'selesai')->sum('delivery_order_price');
        $this->revenueTarget = 300_000_000;

        $previousRevenue = (int) Shipment::where('status', 'selesai')
            ->whereBetween('completed_at', [now()->subDays(60), now()->subDays(30)])
            ->sum('delivery_order_price');

        $this->revenueGrowth = $previousRevenue > 0
            ? round((($this->revenue - $previousRevenue) / $previousRevenue) * 100, 2)
            : 0.0;
    }

    public function render()
    {
        return view('livewire.dashboard.index', [
            'lastMonth' => Shipment::whereMonth('created_at', now()->subMonth()->month)->count()
        ]);
    }
}
