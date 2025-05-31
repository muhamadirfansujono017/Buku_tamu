<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Grafik Kepuasan Layanan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">

<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-center">Grafik Kepuasan Layanan</h1>

    <canvas id="barChart" height="150"></canvas>

    <div class="mt-6 text-center">
         <a href="{{ route('kategori.index') }}" 
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
           Kembali ke Daftar Kategori
        </a>
    </div>
</div>

<script>
    const ctx = document.getElementById('barChart').getContext('2d');

    const labels = {!! json_encode($labels) !!};
    const dataValues = {!! json_encode($values) !!};

    const colors = {
        'Sangat Baik': '#059669',   // hijau gelap
        'Baik': '#10B981',          // hijau sedang
        'Cukup': '#FBBF24',         // kuning
        'Kurang': '#F87171',        // merah muda
        'Buruk': '#EF4444'          // merah terang
    };

    const backgroundColors = labels.map(label => colors[label] || '#6B7280'); // default abu-abu

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Responden',
                data: dataValues,
                backgroundColor: backgroundColors,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.parsed.y} responden`
                    }
                }
            }
        }
    });
</script>

</body>
</html>
