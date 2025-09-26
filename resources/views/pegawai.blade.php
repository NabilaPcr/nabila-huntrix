<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
</head>
<body>
    <h1>Profil Pegawai</h1>
    <p><strong>Nama:</strong> {{ $name }}</p>
    <p><strong>Usia:</strong> {{ $my_age }}</p>

    <p><strong>Hobi:</strong> {{ implode(', ', $hobbies) }}</p>

    <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>

    <p><strong>Sisa Waktu Studi:</strong> {{ $time_to_study_left ?? 'Belum diisi' }}</p>

    <p><strong>Semester Saat Ini:</strong> {{ $current_semester }}</p>

    <p><strong>Pesan:</strong> {{ $study_message }}</p>

    <p><strong>Cita-cita:</strong> {{ implode(', ', $cita_cita) }}</p>
</body>
</html>
