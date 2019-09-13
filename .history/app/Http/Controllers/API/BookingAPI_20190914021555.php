<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\BookingModel;
use DateTime;
class BookingAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('phone'))
        {
            $booking = BookingModel::where([
                ['PHONE_BOOKING',$request->get('phone')],
                ['CHECK_BOOKING',1]])->first();
            if($booking)
            {
                return response()->json(false, 200);
            }
            else {
                return response()->json(true, 200);
            }
            
        }
        else if($request->has('date')) {
            $booking = BookingModel::where([
                ['DATE_BOOK', $request->get('date')],
                ['TIME_BOOK', $request->get('time')]
                ])->get();
            return response()->json($booking, 200);
        }
        // else if($request->has('room'))
        // {
            
        //         $booking = BookingModel::where('UUID_ROOM',$request->get('room'))->get();
        //         // $booking = BookingModel::where([
        //         //     ['UUID_ROOM',$request->get('room')]
        //         //     // ['DATE_BOOK',$request->get('date')]
        //         //     ])->get();
        //         return response()->json($booking, 200);
            
           
        // }
        $booking = BookingModel::orderBy('CREATED_AT','DESC')->get();
       

        return response()->json($booking, 200);
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
    public function booking(Request $request)
    {
        $booking = BookingModel::create([
            "UUID_BOOKING" => $request->get("UUID_BOOKING"),
            "PHONE_BOOKING" =>  $request->get("PHONE_BOOKING"),
            "ACTION_BOOKING" =>  $request->get("ACTION_BOOKING"),
            "NOTE_BOOKING"  =>  $request->get("NOTE_BOOKING")
        ]);
        if($booking)
        {   
            return response()->json($booking, 200);
        }
        else {
            return response()->json('error', 401);
        }
    }
    public function store(Request $request)
    {
        $booking = new BookingModel();
        $booking->UUID_BOOKING =  $request->get("UUID_BOOKING");
        $booking->PHONE_BOOKING =  $request->get("PHONE_BOOKING");
        $booking->ACTION_BOOKING =  $request->get("ACTION_BOOKING");
        $booking->NOTE_BOOKING =  $request->get("NOTE_BOOKING");
        $booking->save();
        return response()->json($booking, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($request->has('date'))
        {
            $booking = BookingModel::where([
                    ['UUID_ROOM',$id],
                    ['DATE_BOOK',$request->get('date')]
                    ])->select('TIME_BOOK')->get();
            return response()->json($booking, 200);
        }
        else if($request->has('type'))
        {
            if($request->get('type') == 'uuid')
            {
                $booking = BookingModel::where('UUID_BOOKING',$id)->orderBy('CREATED_AT','desc')->first();
                return response()->json($booking, 200); 
            }
        }
        $booking = BookingModel::where('PHONE_BOOKING',$id)->orderBy('CREATED_AT','desc')->first();
        return response()->json($booking, 200); 
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
        if($request->get('ACTION_BOOKING') == 2)
        {
           $booking =  BookingModel::where('UUID_BOOKING', $id)->orderBy('CREATED_AT','DESC')->first();
           if($booking)
           {
               $booking->ACTION_BOOKING = $request->get('ACTION_BOOKING');
               $booking->UUID_STORE = $request->get('UUID_STORE');
               $booking->NOTE_BOOKING = $request->get('NOTE_BOOKING');
               $booking->save();
               return response()->json('success', 200);
           }
           else {
            return response()->json('not found', 404);
           }
        }
        // if($request->has("ACTION_BOOKING"))
        // {
        //     if($request->get('ACTION_BOOKING') == 2)
        //     {
        //         $booking = BookingModel::where('UUID_BOOKING',$id)->update([
        //             'NOTE_BOOKING' => $request->get('NOTE_BOOKING'),
        //             'ACTION_BOOKING' => $request->get('action'),
        //             "UUID_STORE" => $request->get('UUID_STORE')
        //         ]);
        //         return response()->json($booking, 200);
        //     }
        //     else {  
        //         $booking = BookingModel::where('UUID_BOOKING',$id)->update([
        //             'NOTE_BOOKING' => $request->get('NOTE_BOOKING'),
        //             'ACTION_BOOKING' => $request->get('action'),
        //             'CODE' => $request->get('CODE'),
        //             'UUID_ROOM' => $request->get('UUID_ROOM'),
        //             'TIME_BOOK' => $request->get('TIME_BOOK'),
        //             'DATE_BOOK' => $request->get('DATE_BOOK')
        //         ]);
        //         return response()->json($booking, 200);
        //     }
        // }
        // else if($request->has('token')) {
        //     $booking = BookingModel::where('UUID_BOOKING',$id)->update([
        //         'NOTIFY_TOKEN' => $request->get('token')
        //     ]);
        //     return response()->json('success', 200);
        // }
        // else if($request->has('check_booking'))
        // {
        //     $booking = BookingModel::where('UUID_BOOKING',$id)->update([
        //         'CHECK_BOOKING' => $request->get('check_booking')
        //     ]);
        //     return response()->json($booking, 200);
        // }
        // else if($request->has('type'))
        // {
        //     if($request->get('type') == 'delete')
        //     {   
        //         $booking = BookingModel::where('UUID_BOOKING',$id)->update([
        //             'CHECK_BOOKING' => 1,
        //             'NOTE_BOOKING' => 'khách hàng tự đã hủy đặt lịch!'
        //         ]);
        //         return response()->json($booking, 200);
        //     }
        //     else if($request->get('type') == 'question')
        //     {
        //         $booking = BookingModel::where('UUID_BOOKING',$id)->update([
        //             'NOTE_BOOKING' => 'Khách hàng đã trả lời phiếu khao sát!'
        //         ]);
        //         return response()->json($booking, 200);
        //     }
        //     else {
        //         $booking = BookingModel::where('UUID_BOOKING',$id)->update([
        //             'CHECK_BOOKING' => 1,
        //             'NOTE_BOOKING' => 'khách hàng tự đã đặt lịch lại!'
        //         ]);
        //         return response()->json($booking, 200);
        //     } 
        // }
        // $booking = BookingModel::where('UUID_BOOKING',$id)->update($request->all());
        // return response()->json($booking, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        DetailServiceModel::where('UUID_BOOKING',$id)->delete();
        $booking = BookingModel::where('UUID_BOOKING',$id)->delete();
        return response()->json($booking, 200);
    }
}
