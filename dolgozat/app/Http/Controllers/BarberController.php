<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BarberController extends Controller {
    
    //osszes lekerd.
    public function index() {
        return response()->json(Barber::all(), Response::HTTP_OK);
    }

    //lekerd.
    public function show($id) {
        $barber = Barber::find($id);
        if (!$barber) {
            return response()->json(['error' => 'A barber nem található!'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($barber, Response::HTTP_OK);
    }

    //uj
    public function store(Request $request) {
        $request->validate([
            'barber_name' => 'required|string|max:255'
        ], [
            'barber_name.required' => 'A barber neve kötelező!',
            'barber_name.max' => 'A barber neve legfeljebb 255 karakter lehet!'
        ]);

        $barber = Barber::create($request->all());
        return response()->json($barber, Response::HTTP_CREATED);
    }

    //frissites
    public function update(Request $request, $id) {
        $barber = Barber::find($id);
        if (!$barber) {
            return response()->json(['error' => 'A barber nem található!'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'barber_name' => 'sometimes|required|string|max:255'
        ], [
            'barber_name.max' => 'A barber neve legfeljebb 255 karakter lehet!'
        ]);

        $barber->update($request->all());
        return response()->json($barber, Response::HTTP_OK);
        
    }

    //torles
    public function destroy($id) {
        $barber = Barber::find($id);
        if (!$barber) {
            return response()->json(['error' => 'A barber nem található!'], Response::HTTP_NOT_FOUND);
        }

        $barber->delete();
        return response()->json(['message' => 'A barber sikeresen törölve!'], Response::HTTP_OK);
    }
}
