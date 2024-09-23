<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPEG MAN 2 | Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/team.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body>
    <div class="team-area sp">
        <div class="container">
            <div class="row">

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Kelas</th>
                            <th colspan="3">Jumlah Siswa</th>
                        </tr>
                        <tr>
                            <td>L</td>
                            <td>P</td>
                            <td>Jumlah</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>X - A</td>
                            <td>11</td>
                            <td>19</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>X - B</td>
                            <td>14</td>
                            <td>15</td>
                            <td>29</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>X - C</td>
                            <td>11</td>
                            <td>18</td>
                            <td>29</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>X - D</td>
                            <td>9</td>
                            <td>22</td>
                            <td>31</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>X - E</td>
                            <td>8</td>
                            <td>23</td>
                            <td>31</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>X - F</td>
                            <td>9</td>
                            <td>21</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>X - G</td>
                            <td>10</td>
                            <td>20</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>X - H</td>
                            <td>8</td>
                            <td>20</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>X - I</td>
                            <td>11</td>
                            <td>17</td>
                            <td>28</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>X - J</td>
                            <td>12</td>
                            <td>17</td>
                            <td>29</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    {{-- @include('modals.member_detail'); --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
