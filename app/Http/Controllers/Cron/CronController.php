<?php

namespace App\Http\Controllers\Cron;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Models\App\User;

class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        function httpPost($url,$params)
        {
            $postData = $params;

            $ch = curl_init();

            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch,CURLOPT_USERAGENT,getRandomUserAgent());

            $output=curl_exec($ch);

            curl_close($ch);
            return $output;

        }


        function getRandomUserAgent()
        {
            $userAgents=array(
                "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",
                "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)",
                "Opera/9.20 (Windows NT 6.0; U; en)",
                "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; en) Opera 8.50",
                "Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.1) Opera 7.02 [en]",
                "Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; fr; rv:1.7) Gecko/20040624 Firefox/0.9",
                "Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48"
            );
            $random = rand(0,count($userAgents)-1);

            return $userAgents[$random];
        }


        //$params = "SITE=AAVRAAVR&LANGUAGE=ES&TRIPFLOW=YES&SO_SITE_OFFICE_ID=CCSV008AA&SO_QUEUE_OFFICE_ID=CCSV008AA&DIRECT_LOGIN=NO&B_ANY_TIME_1=FALSE&B_ANY_TIME_2=TRUE&SO_SITE_PRIMARY_CURRENCY=VEF&SO_SITE_USER_CURRENCY_CODE=VEF&ARRANGE_BY=&REFRESH=0&DISPLAY_TYPE=1&EMBEDDED_TRANSACTION=FlexPricerAvailability&DATE_RANGE_VALUE_1=7&DATE_RANGE_VALUE_2=7&DATE_RANGE_QUALIFIER_1=C&DATE_RANGE_QUALIFIER_2=C&COMMERCIAL_FARE_FAMILY_1=ARGENTINA&PRICING_TYPE=I&SEVEN_DAY_SEARCH=TRUE&B_LOCATION_1=CCS&E_LOCATION_1=EZE&B_LOCATION_2=&E_LOCATION_2=&B_DATE_1=201611191200&B_DATE_2=201612310000&TRAVELLER_TYPE_1=ADT&TRAVELLER_TYPE_2=&TRAVELLER_TYPE_3=&TRAVELLER_TYPE_4=&HAS_INFANT_1=FALSE&HAS_INFANT_2=FALSE&HAS_INFANT_3=FALSE&HAS_INFANT_4=FALSE&SWITCHE=0&TRIP_TYPE=R&EXTERNAL_ID=US&SO_SITE_MOD_E_TICKET=TRUE&SO_LANG_SITE_AGENCY_LINE1=%3Ca+target%3D%27blank%27+href%3D%27http%3A%2F%2Fconviasa.aero%27+%3EConviasa%3C%2Fa%3E&SO_LANG_SITE_AGENCY_LINE2=VENTAS+INTERNET&SO_LANG_SITE_AGENCY_LINE3=AV.+INTERCOMUNAL+AEROPUERTO+DE+MAIQUETIA&SO_LANG_SITE_AGENCY_LINE4=HANGARES+DE+CONVIASA&SO_LANG_SITE_AGENCY_LINE5=MAIQUETIA%2C+EDO.+VARGAS%2C+VENEZUELA.&SO_LANG_SITE_AGENCY_LINE6=%2B58%28212%29303.31.37&SO_LANG_SITE_EMAIL_ADDRESS=ventas.psp%40conviasa.aero&SO_SITE_MOP_EXT=TRUE&opcion_iv=iv&ORIGEN=CCS&DESTINO=EZE&fecha_desde=19%2F11%2F2016&fecha_hasta=31%2F12%2F2016&adultos=1&ninos=0&bebes=0
//Name";

        $params = "SITE=AAVRAAVR&LANGUAGE=ES&TRIPFLOW=YES&SO_SITE_OFFICE_ID=CCSV008AA&SO_QUEUE_OFFICE_ID=CCSV008AA&DIRECT_LOGIN=NO&B_ANY_TIME_1=FALSE&B_ANY_TIME_2=TRUE&SO_SITE_PRIMARY_CURRENCY=VEF&SO_SITE_USER_CURRENCY_CODE=VEF&ARRANGE_BY=&REFRESH=0&DISPLAY_TYPE=1&EMBEDDED_TRANSACTION=FlexPricerAvailability&DATE_RANGE_VALUE_1=7&DATE_RANGE_VALUE_2=7&DATE_RANGE_QUALIFIER_1=C&DATE_RANGE_QUALIFIER_2=C&COMMERCIAL_FARE_FAMILY_1=ARGENTINA&PRICING_TYPE=I&SEVEN_DAY_SEARCH=TRUE&B_LOCATION_1=CCS&E_LOCATION_1=EZE&B_LOCATION_2=&E_LOCATION_2=&B_DATE_1=201611261200&B_DATE_2=201612310000&TRAVELLER_TYPE_1=ADT&TRAVELLER_TYPE_2=&TRAVELLER_TYPE_3=&TRAVELLER_TYPE_4=&HAS_INFANT_1=FALSE&HAS_INFANT_2=FALSE&HAS_INFANT_3=FALSE&HAS_INFANT_4=FALSE&SWITCHE=0&TRIP_TYPE=R&EXTERNAL_ID=US&SO_SITE_MOD_E_TICKET=TRUE&SO_LANG_SITE_AGENCY_LINE1=%3Ca+target%3D%27blank%27+href%3D%27http%3A%2F%2Fconviasa.aero%27+%3EConviasa%3C%2Fa%3E&SO_LANG_SITE_AGENCY_LINE2=VENTAS+INTERNET&SO_LANG_SITE_AGENCY_LINE3=AV.+INTERCOMUNAL+AEROPUERTO+DE+MAIQUETIA&SO_LANG_SITE_AGENCY_LINE4=HANGARES+DE+CONVIASA&SO_LANG_SITE_AGENCY_LINE5=MAIQUETIA%2C+EDO.+VARGAS%2C+VENEZUELA.&SO_LANG_SITE_AGENCY_LINE6=%2B58%28212%29303.31.37&SO_LANG_SITE_EMAIL_ADDRESS=ventas.psp%40conviasa.aero&SO_SITE_MOP_EXT=TRUE&opcion_iv=iv&ORIGEN=CCS&DESTINO=EZE&fecha_desde=26%2F11%2F2016&fecha_hasta=31%2F12%2F2016&adultos=1&ninos=0&bebes=0";

        $cadena = httpPost("https://wftc1.e-travel.com/plnext/Conviasa/Override.action", $params);
        $buscar = "No existe disponibilidad de asientos en la ruta seleccionada. Por favor modifique las fechas de su viaje";
        $resultado = strpos($cadena, $buscar);

        if($resultado !== FALSE){
            dd('No hay pasajes aun');
        }
        else {
//            Mail::raw('Hay pasaje apurate..', function($message)
//            {
//                $message->from('conviasa@bot.com', 'Im bot');
//
//                $message->to(['sandrajaimesduran@gmail.com', 'glendy.ramirez1989@gmail.com']);
//            });

            Mail::send('emails.mailEvent', ['html' => $cadena], function($message)
            {
                $message->from('conviasa@bot.com', 'Im bot');

                $message->to(['sandrajaimesduran@gmail.com', 'glendy.ramirez1989@gmail.com']);
            });


            dd('Se encontro pasajes notificamos por correo');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
