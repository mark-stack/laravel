<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Event;
  
class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
       
        $user = Auth()->user();

        if($request->ajax()) {
             $data = Event::query()
                ->whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->where('user_id',$user->id)
                ->get(['id', 'title', 'start', 'end','user_id']);

             return response()->json($data);
        }
        else{
            $events = array();
            $all = Event::query()
            ->where('user_id',$user->id)
            ->get(['id', 'title', 'start', 'end','user_id']);

            foreach($all as $item){
                $events[] = [
                    'title' => $item->title,
                    'start' => $item->start,
                    'end' => $item->end,
                    'user_id' => $item->user_id,
                    'id' => $item->id
                ];
            }

            return view('backend.fullcalendar',['events' => $events]);
        }
        
        
    }
 

    public function ajax(Request $request)
    {

        switch ($request->type) {
            
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
                  'user_id' => $request->user_id,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':

                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end
                ]);
    
                return response()->json($event);
              
                break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
        
        

    }
}