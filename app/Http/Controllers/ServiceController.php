<?php

namespace App\Http\Controllers;


use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Question;
use App\Models\ServiceName;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

    public static function getServiceTypes(){
        $questions=Question::all();

        return $questions;
    }


    /**
     * Show the events page //TODO: check naming conventions
     */
    public function list()
    {
        $servicesNames=ServiceName::all();
        return view('pages.serviceList', ['services' => $servicesNames]);
    }

    // Show the event page
    public function show($eventId)
    {
        $event = Event::find($eventId);
        return view('pages.event', ['event' => $event]);
    }


    public function createServiceForm($id)
    {
        $question=Question::find($id);
        $organicUnits=OrganicUnitController::getOrganicUnits();
        return view('pages.createSingleServiceForm', ['question' => $question,'organicunits'=>$organicUnits]);
    }


    protected function validator(array $data)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        return Validator::make($data, [
            'atribute1'=>'required|string',
            'atribute2'=>'nullable|string',
            'atribute3'=>'nullable|string',
            'atribute4'=>'nullable|string',
            'atribute5'=>'nullable|string',
            'atribute6'=>'nullable|string',
            'atribute7'=>'nullable|string',
            'atribute8'=>'nullable|string',
            'atribute9'=>'nullable|string',
            'atribute10'=>'nullable|string',
            'servicename'=> 'required|string',
            'purpose' => 'nullable|string',
            'email ' => 'nullable|string',
            'url' => 'nullable|regex:' . $regex,
            'contactperson' => 'nullable|string',
            'startdate' => 'nullable|date|date_format:Y-m-d',
            'enddate' => 'nullable|date|after_or_equal:startdate|date_format:Y-m-d',
        ]);
    }


    public function createService(Request $request){

        if (!Auth::check()) return redirect('/login');

        $this->validator($request->all())->validate();
        
        $question=Question::find($request->input('questionsid'));
        $user = Auth::user();
        
        $serviceType=ServiceType::create([
            'atribute1'=>$request->input('atribute1'),
            'atribute2'=>$request->input('atribute2'),
            'atribute3'=>$request->input('atribute3'),
            'atribute4'=>$request->input('atribute4'),
            'atribute5'=>$request->input('atribute5'),
            'atribute6'=>$request->input('atribute6'),
            'atribute7'=>$request->input('atribute7'),
            'atribute8'=>$request->input('atribute8'),
            'atribute9'=>$request->input('atribute9'),
            'atribute10'=>$request->input('atribute10'),
            'questionsid'=>$request->input('questionsid'),
        ]);
        
        // TODO: Por isto a funcionar
        //$question->serviceType()->save($serviceType);
        
        $service = Service::create([
            'requeststatus' => 'Pending',
            'requesttype' => 'Create',
            'servicenameid' => $request->input('servicenameid'),
            'purpose' => $request->input('purpose'),
            'email' => $request->input('email'),
            'url' => $request->input('url'),
            'datecreated' => date('Y-m-d'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'userid'=> $user->userid,
            'organicunitid' => $request->input('organicunitid'),
            'servicetypeid' => $serviceType->servicetypeid,
        ]);

    
        //$serviceType->service()->save($service);
        
        $user->services()->save($service);
        
        // TODO: CHANGE WHEN USER CAN SEE EVENTS IN PROFILE
        return redirect('/my_requests')->with('success', 'Service creation request sent successfully.');
    }

    public function editServiceForm($id)
    {
        $event = Event::find($id);
        $tags = TagController::getAllTags();
        $organicUnits=OrganicUnitController::getOrganicUnits();
        return view('pages.editEventForm', ['event' => $event, 'tags' => $tags,'organicunits'=>$organicUnits]);
    }

    public function editService(Request $request)
    {
        if (!Auth::check()) return redirect('/login');
        $this->validator($request->all())->validate();
        $user = Auth::user();
        $event = Event::create([
            'requeststatus' => 'Pending',
            'requesttype' => 'Edit',
            'eventnameportuguese' => $request->input('eventnamept'),
            'eventnameenglish' => $request->input('eventnameen'),
            'address' => $request->input('address'),
            'urlportuguese' => $request->input('urlportuguese'),
            'urlenglish' => $request->input('urlenglish'),
            'emailtechnical' => $request->input('emailtechnical'),
            'emailcontact' =>$request->input('emailcontact'),
            'datecreated' => date('Y-m-d'),
            'contactperson' => $request->input('contactperson'),
            'description' => $request->input('description'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'userid'=> $user->userid,
            'organicunitid' => $request->input('organicunitid')
        ]);
        $tags = $request->input('tags');
        $tagNames = explode(',', $tags);

        foreach ($tagNames as $tagName) {
            $tagId = Tag::where('tagnameportuguese',$tagName)->orWhere('tagnameenglish',$tagName)->value('tagid');
            if ($tagId) {
                $tagIds[] = (int) $tagId;
            }
            else {
                return redirect()->back()->withErrors(['tag' => 'Tag not found, id: ' . $tagId]);
            }
        }
        $event->tags()->attach($tagIds);
        $event->save();
        $user->events()->save($event);

        $events = $user->events()->get();
        $services = $user->services()->get();
        return redirect()->route('my.requests', ['events' => $events, 'services' => $services])->with('success', 'Event edit request sent successfully.');
    }

    public function deleteService($id)
    {
        if (!Auth::check()) return redirect('/login');

        $service = Service::find($id);
        $service->user()->detach();
        $service->organicUnit()->detach();
        
        // Deleting entry in ServiceType
        $serviceTypeId=$service->serviceType();
        $serviceType=ServiceType::find($serviceTypeId);
        $serviceType->question()->detach();
        $serviceType->service()->detach();// PRECISO MESMO DESTE?
        $serviceType->delete();

        $service->serviceType()->detach();  
        $service->delete();


        return redirect()->back()->with('success', 'Service deleted successfully.');
    }
}
