<!-- export.blade.php -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Dokumen</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dokumen as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->name }}</td>
            <td>
                @if ($item->dokumen)
                @php
                    $fileFullPath = asset('storage/' . $item->dokumen);
                @endphp
                <a href="{{ $fileFullPath }}">{{ basename($item->dokumen) }}</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
