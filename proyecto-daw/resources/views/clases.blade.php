@extends('layouts.app-layout')

@section('content')
    

    <div class="container mt-5">
        <h1 class="mb-4">Horario de Clases</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sábado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>10:00 AM</td>
                    <td>Yoga</td>
                    <td>Kickboxing</td>
                    <td>BodyCombat</td>
                    <td>HIIT</td>
                    <td>Crossfit</td>
                    <td>Pilates</td>
                </tr>
                <tr>
                    <td>12:00 PM</td>
                    <td>Kickboxing</td>
                    <td>MMA</td>
                    <td>CoreBuild</td>
                    <td>Yoga</td>
                    <td>Boxeo</td>
                    <td>HIIT</td>
                </tr>
                <tr>
                    <td>4:00 PM</td>
                    <td>AeroBox</td>
                    <td>Capoeira</td>
                    <td>Yoga</td>
                    <td>BodyCombat</td>
                    <td>Calistenia</td>
                    <td>Kickboxing</td>
                </tr>
                <tr>
                    <td>6:00 PM</td>
                    <td>Boxeo</td>
                    <td>Kickboxing</td>
                    <td>Yoga</td>
                    <td>HIIT</td>
                    <td>MMA</td>
                    <td>CoreBuild</td>
                </tr>
                <tr>
                    <td>8:00 PM</td>
                    <td>Capoeira</td>
                    <td>CoreBuild</td>
                    <td>Kickboxing</td>
                    <td>Pilates</td>
                    <td>BodyCombat</td>
                    <td>Yoga</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endsection
