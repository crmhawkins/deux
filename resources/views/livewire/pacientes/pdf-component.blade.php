<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consentimiento</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 50px; position: relative; }
        .logo { position: absolute; top: 0; left: 0; width: 200px; }
        .header-content { margin-top: 100px; }
        .clinic-info { text-align: right; margin-top: -40px; }
        .clinic-info h3 { margin: 0; }
        .clinic-info p { margin: 0; line-height: 1.2; }
        .content { margin-top: 30px; text-align: justify; }
        .info-signature { page-break-inside: avoid; display: inline-block; width: 100%; margin-top: 50px; }
        .info-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .info-table td { padding: 5px; }
        .signature { margin-top: 30px; }
        .signature-table { width: 100%; border-collapse: collapse; }
        .signature-table td { padding: 10px; }
        .signature img { width: 200px; margin-top: 10px; }
        .signature p { margin: 0; }
        .content h1 { text-align: center; }
    </style>
</head>
<body>
    <img src="{{ public_path('assets/images/logo_color.png') }}" class="logo" alt="Logo DEUX Clínica Médica">
    <div class="header">
        <div class="clinic-info">
            <h3>DEUX CLÍNICA MÉDICA S.L.</h3>
            <p>Urbanización Los Sauces,<br>
            Bloque 4 - Local 6,<br>
            11202, Algeciras, Cádiz <br>
            956 66 80 14 <br>
            670 05 46 06 <br>
            info@deuxclinicamedica.es</p>
        </div>
    </div>
    <div class="content">
        <h1>{{$documento->titulo}}</h1>
        <p style="white-space: pre-line;">{{$documento->texto}}</p>
    </div>
    <div class="info-signature">
        <div class="info">
            <table class="info-table">
                <tr>
                    <td><strong>Nombre:</strong> {{$paciente->nombre}}</td>
                    <td><strong>Apellido:</strong> {{$paciente->apellido}}</td>
                    <td><strong>DNI:</strong> {{$paciente->dni}}</td>
                </tr>
            </table>
        </div>
        <div class="signature">
            <table class="signature-table">
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <p>En {{$dia}} de {{$mes}} de {{$año}}</p>
                    </td>
                    <td style="text-align: right;">
                        <p>Firma del Paciente:</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right;">
                        <img src="{{ asset('storage/assets/firma/'. $documento->firma) }}" alt="Firma del Paciente">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
