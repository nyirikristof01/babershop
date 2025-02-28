<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppointmentController extends Controller {

    // osszes lekerd.
    public function index() {
        return response()->json(Appointment::with('barber')->get(), Response::HTTP_OK);
    }

    //lekerd.
    public function show($id) {
        $appointment = Appointment::with('barber')->find($id);
        if (!$appointment) {
            return response()->json(['error' => 'Az időpont nem található!'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($appointment, Response::HTTP_OK);
    }

    //uj
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'barber_id' => 'required|exists:barbers,id',
            'appointment' => 'required|date'
        ], [
            'name.required' => 'A név megadása kötelező!',
            'name.max' => 'A név legfeljebb 255 karakter lehet!',
            'barber_id.required' => 'A barber kiválasztása kötelező!',
            'barber_id.exists' => 'Nem létező barberhez nem lehet időpontot foglalni!',
            'appointment.required' => 'Az időpont megadása kötelező!',
            'appointment.date' => 'Az időpontnak érvényes dátumnak kell lennie!'
        ]);
         
        $appointment = Appointment::create($request->all());
        return response()->json($appointment, Response::HTTP_CREATED);
    }

    //frissetes
    public function update(Request $request, $id) {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(['error' => 'Az időpont nem található!'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'barber_id' => 'sometimes|required|exists:barbers,id',
            'appointment' => 'sometimes|required|date'
        ]);

        $appointment->update($request->all());
        return response()->json($appointment, Response::HTTP_OK);
    }

    //torls
    public function destroy($id) {
        $appointment = Appointment::find($id);
        if (!$appointment) {
            return response()->json(['error' => 'Az időpont nem található!'], Response::HTTP_NOT_FOUND);
        }

        $appointment->delete();
        return response()->json(['message' => 'Az időpont sikeresen törölve!'], Response::HTTP_OK);
    }
}
