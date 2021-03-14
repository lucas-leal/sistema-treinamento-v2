<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CertificateController extends Controller
{
    public function index(Request $request, string $courseId)
    {
        $course = Course::findOrFail($courseId);
        $registration = $course->registrations()->where('user_id', $request->user()->id)->first();

        if (!$registration || !$registration->isConcluded()) {
            throw new BadRequestHttpException("Error to issue certificate");
        }

        $certificate = $registration->certificate;
        
        if (!$certificate) {
            $certificate = new Certificate();
            $registration->certificate()->save($certificate);
        }

        $html = view('certificate/certificate', ['certificate' => $certificate]);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("certificate-{$certificate->id}.pdf");
    }
}
