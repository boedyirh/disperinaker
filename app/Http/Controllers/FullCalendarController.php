<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventModel;
use App\Models\TimeDimensionModel;
use App\Models\Ak1SlotWawancaraModel;

class FullCalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->TimeDimensionModel = new TimeDimensionModel();
        $this->Ak1SlotWawancaraModel = new Ak1SlotWawancaraModel();

    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {

        if($request->ajax()) {

             $data = EventModel::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);

             return response()->json($data);
        }

        return view('v_penetapan_libur');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {

        switch ($request->type) {
           case 'add':
              $event = EventModel::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
              //Set hari libur di tabel time_dimension
              $tanggal = $request->start;
              $data =['harilibur_flag'=>'t'];
              $setHariLibur = $this->TimeDimensionModel->updateData($tanggal,$data);

              //Set hari libur di tabel tbl_slot_wawancara
              $data =['hari_libur'=>'t'];
              $setHariLibur = $this->Ak1SlotWawancaraModel->updateLibur($tanggal,$data);


              return response()->json($event);
             break;

           case 'update':
            //Hapus yang lama
            $event  =EventModel::find($request->id);
            $tanggal = $event->start;
            $data =['harilibur_flag'=>'f',];
            $setHariLibur = $this->TimeDimensionModel->updateData($tanggal,$data);

            //Update dengan yang baru
            $event = EventModel::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

            $data =['harilibur_flag'=>'t'];
            $setHariLibur = $this->TimeDimensionModel->updateData($request->start,$data);

            //Set hari libur di tabel tbl_slot_wawancara
            $data =['hari_libur'=>'t'];
            $setHariLibur = $this->Ak1SlotWawancaraModel->updateLibur($tanggal,$data);

              return response()->json($event);
             break;

           case 'delete':
            $event  =EventModel::find($request->id);
            $tanggal = $event->start;
            //Set harilibur menjadi false
            $data =['harilibur_flag'=>'f',];
            $setHariLibur = $this->TimeDimensionModel->updateData($tanggal,$data);

            //Set  harilibur flag menjadi false di tabel tbl_slot_wawancara
            $data =['hari_libur'=>'f'];
            $setHariLibur = $this->Ak1SlotWawancaraModel->updateLibur($tanggal,$data);


            $event = EventModel::find($request->id)->delete();
              return response()->json($event);
             break;

           default:
             # code...
             break;
        }
    }
}

