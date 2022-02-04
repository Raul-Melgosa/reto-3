<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailIncidencia;

class MailControler extends Controller
{
    public function sendEmailIncidencia(Request $request)
    {

        $email=$request->mail;
        $contenido=$request->contenido;
        $details = [
            'title' => 'Nueva incidencia',
            'body'=>$contenido
        ];
        /*$email=[
            'roberto.cerdan@ikasle.egibide.org',
            'barbara.lopez@ikasle.egibide.org',
            'raul.melgosa@ikasle.egibide.org'
        ];
        */

        Mail::to($email)->send(new MailIncidencia($details));
        return "Correo enviado";
    }
    public function sendEmailResuelta($email, $contenido)
    {
        $details = [
            'title' => 'Incidencia resuelta',
            'body'=>$contenido
            ];
        /*
        $email=[
            'roberto.cerdan@ikasle.egibide.org',
            'barbara.lopez@ikasle.egibide.org',
            'raul.melgosa@ikasle.egibide.org'
        ];
        */
        Mail::to($email)->send(new MailIncidencia($details));
        return "Correo enviado";
    }

    public function sendEmail($email, $titulo, $contenido)
    {
        $details = [
            'title' => $titulo,
            'body'=>$contenido
        ];
        Mail::to($email)->send(new MailIncidencia($details));
    }
}
