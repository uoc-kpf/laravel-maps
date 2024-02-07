<?php

namespace Larswiegers\LaravelMaps\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class Leaflet extends Component
{

    const DEFAULTMAPID = "defaultMapId";

    public int $zoomLevel;

    public int $maxZoomLevel;

    public bool $zoomControl;

    public array $centerPoint;

    public array $markerLayers;

    public $tileHost;

    public $mapId;

    public string $attribution;

    public string $leafletVersion;

    public array $boundsCorner1;

    public array $boundsCorner2;

    public function __construct(
        $centerPoint = [0,0],
        $markerLayers = [],
        $zoomLevel = 13,
        $maxZoomLevel = 18,
        $zoomControl = true,
        $tileHost = 'openstreetmap',
        $id = self::DEFAULTMAPID,
        $attribution = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors, Imagery © Mapbox.com',
        $leafletVersion = "latest",
        $boundsCorner1 = [],
        $boundsCorner2 = []
    )
    {
        $this->centerPoint = $centerPoint;
        $this->zoomLevel = $zoomLevel;
        $this->maxZoomLevel = $maxZoomLevel;
        $this->zoomControl = $zoomControl;
        $this->markerLayers = $markerLayers;
        $this->tileHost = $tileHost;
        $this->mapId = $id;
        $this->attribution = $attribution;
        $this->leafletVersion = $leafletVersion;
        $this->boundsCorner1 = $boundsCorner1;
        $this->boundsCorner2 = $boundsCorner2;
    }

    public function render(): View
    {
        return view('maps::components.leaflet', [
            'centerPoint' => $this->centerPoint,
            'zoomLevel' => $this->zoomLevel,
            'maxZoomLevel' => $this->maxZoomLevel,
            'markers' => $this->markerLayers,
            'tileHost' => $this->tileHost,
            'mapId' => $this->mapId === self::DEFAULTMAPID ? Str::random() : $this->mapId,
            'attribution' => $this->attribution,
            'leafletVersion' => $this->leafletVersion ?? "1.7.1",
            'boundsCorner1' => $this->boundsCorner1,
            'boundsCorner2' => $this->boundsCorner2
        ]);
    }
}
