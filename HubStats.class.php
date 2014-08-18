<?php

/**
 * Class HubStats
 *
 * A simple phpVMS class to display cumulative statistics per hub,
 * or any other airport listed in the database.
 *
 * @author Tom Sterritt <tom@sterri.tt.>
 * @author Pierre Lavaux <pierre@zonexecutive.com>
 * @copyright Copyright (c) 2012, Tom Sterritt
 * @link https://github.com/tomsterritt/HubStats
 */

class HubStats extends Codondata
{

    /**
     * Details of pilots at this hub
     *
     * @param $icao string
     * @return array
     */

    public static function Pilots($icao)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "pilots WHERE hub = '" . $icao . "'");
    }

    /**
     * Number of pilots at this hub
     *
     * @param $icao string
     * @return int
     */

    public static function CountPilots($icao)
    {
        $results = DB::get_row("SELECT COUNT(pilotid) as count FROM " . TABLE_PREFIX . "pilots WHERE hub = '" . $icao . "'");
        return $results->count;
    }

    /**
     * Number of flights flown from or to this hub
     *
     * @param $icao string
     * @return int
     */

    public static function CountFlights($icao)
    {
        $results = DB::get_row("SELECT COUNT(pirepid) as count FROM " . TABLE_PREFIX . "pireps WHERE arricao = '" . $icao . "' OR depicao = '" . $icao . "'");
        return $results->count;
    }

    /**
     * Number of flights flown from this hub
     *
     * @param $icao string
     * @return int
     */

    public static function CountFlightsFrom($icao)
    {
        $results = DB::get_row("SELECT COUNT(pirepid) as count FROM " . TABLE_PREFIX . "pireps WHERE depicao = '" . $icao . "'");
        return $results->count;
    }

    /**
     * Number of flights flown to this hub
     *
     * @param $icao string
     * @return int
     */

    public static function CountFlightsTo($icao)
    {
        $results = DB::get_row("SELECT COUNT(pirepid) FROM " . TABLE_PREFIX . "pireps WHERE arricao = '" . $icao . "'");
        return $results->count;
    }

    /**
     * Details of flights using this hub, for table etc
     *
     * @param $icao string
     * @param int $limit
     * @return array
     */

    public static function FlightsDetails($icao, $limit = 10)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "pireps WHERE depicao = '" . $icao . "' OR arricao = '" . $icao . "' ORDER BY submitdate DESC LIMIT " . intval($limit));
    }

    /**
     * Number of schedules from or to this hub
     *
     * @param $icao string
     * @return int
     */

    public static function CountRoutes($icao)
    {
        $results = DB::get_row("SELECT COUNT(id) as count FROM " . TABLE_PREFIX . "schedules WHERE depicao = '" . $icao . "' OR arricao = '" . $icao . "'");
        return $results->count;
    }

    /**
     * Number of schedules from this hub
     *
     * @param $icao string
     * @return int
     */

    public static function CountRoutesFrom($icao)
    {
        $results = DB::get_row("SELECT COUNT(id) as count FROM " . TABLE_PREFIX . "schedules WHERE depicao = '" . $icao . "'");
        return $results->count;
    }

    /**
     * Number of schedules to this hub
     *
     * @param $icao string
     * @return int
     */

    public static function CountRoutesTo($icao)
    {
        $results = DB::get_results("SELECT COUNT(id) as count FROM " . TABLE_PREFIX . "schedules WHERE arricao = '" . $icao . "'");
        return $results->count;
    }

    /**
     * Number of miles flown to or from this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalMiles($icao)
    {
        $result = DB::get_row("SELECT SUM(distance) as miles FROM " . TABLE_PREFIX . "pireps WHERE depicao = '" . $icao . "' OR arricao = '" . $icao . "'");
        return $result->miles;
    }

    /**
     * Number of miles flown from this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalMilesFrom($icao)
    {
        $result = DB::get_row("SELECT SUM(distance) as miles FROM " . TABLE_PREFIX . "pireps WHERE depicao = '" . $icao . "'");
        return $result->miles;
    }

    /**
     * Number of miles flown to this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalMilesTo($icao)
    {
        $result = DB::get_row("SELECT SUM(distance) as miles FROM " . TABLE_PREFIX . "pireps WHERE arricao = '" . $icao . "'");
        return $result->miles;
    }

    /**
     * Number of miles flown to or from this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalHours($icao)
    {
        $result = DB::get_row("SELECT SUM(flighttime) as hours FROM " . TABLE_PREFIX . "pireps WHERE depicao = '" . $icao . "' OR arricao = '" . $icao . "'");
        return $result->hours;
    }


    /**
     * Number of miles flown from this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalHoursFrom($icao)
    {
        $result = DB::get_row("SELECT SUM(flighttime) as hours FROM " . TABLE_PREFIX . "pireps WHERE depicao = '" . $icao . "'");
        return $result->hours;
    }

    /**
     * Number of miles flown to this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalHoursTo($icao)
    {
        $result = DB::get_row("SELECT SUM(flighttime) as hours FROM " . TABLE_PREFIX . "pireps WHERE arricao = '" . $icao . "'");
        return $result->hours;
    }

    /**
     * How much fuel used by inbound flights for this hub
     *
     * @param $icao string
     * @return float
     * @deprecated
     */

    public static function TotalFuelUsed($icao)
    {
        $result = DB::get_row("SELECT SUM(fuelused) as fuel FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'");
        return $result->fuel;
    }

    /**
     * How much fuel used by flights to and out of this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalFuel($icao)
    {
        $result = DB::get_row("SELECT SUM(fuelused) as fuel FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."' OR depicao = '".$icao."'");
        return round($result->fuel, 1);
    }

    /**
     * How much fuel used by inbound flights for this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalFuelInbound($icao)
    {
        $result = DB::get_row("SELECT SUM(fuelused) as fuel FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'");
        return round($result->fuel, 1);
    }

    /**
     * How much fuel used by outbound flights for this hub
     *
     * @param $icao string
     * @return float
     */

    public static function TotalFuelOutbound($icao)
    {
        $result = DB::get_row("SELECT SUM(fuelused) as fuel FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."'");
        return round($result->fuel, 1);
    }

}
