<!DOCTYPE html>
<html>
<head>
    <title>Sales Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10 font-sans">
    <div class="max-w-4xl mx-auto bg-white p-8 border-4 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
        <h2 class="text-3xl font-black uppercase tracking-tight mb-6 text-black border-b-4 border-black pb-2">
            Monthly Sales Overview
        </h2>

        <canvas id="salesChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const labels = @json($labels); 
        const data = @json($data);

        new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Sales ($)',
                    data: data,
                    backgroundColor: '#000000', 
                    borderColor: '#000000',
                    borderWidth: 2,
                    borderRadius: 0, 
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: 'black',
                            font: { weight: 'bold', family: 'sans-serif' }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: '#e5e7eb' },
                        ticks: { color: 'black', font: { weight: 'bold' } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { color: 'black', font: { weight: 'bold' } }
                    }
                }
            }
        });
    </script>
</body>
</html>