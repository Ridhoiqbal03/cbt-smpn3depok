<table>
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Email</th>
            <th>Jumlah Benar</th>
            <th>Skor</th>
            <th>Grade</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $index => $result)
            <tr>
                <td>{{ $result['student']->name }}</td> 
                <td>{{ $result['student']->email }}</td> 
                <td>{{ $result['correctAnswers'] }} / {{ $totalQuestions }}</td>
                <td>{{ $result['score'] }}</td> 
                <td>{{ $result['grade'] }}</td>
                <td>
                  @if ($result['passed'])
                    <span>Lulus</span>
                  @else
                    <span>Tidak Lulus</span>
                  @endif
                </td> 
            </tr>
        @endforeach
    </tbody>
</table>
