@extends('layouts.dosen')

@section('content')
<!-- Load Tailwind CSS (as it seems the original template uses it) and Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<div class="p-6 md:p-10 bg-gray-100 min-h-screen font-sans">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header + Dropdown -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                Monitoring Metode Pembelajaran
            </h1>
            <!-- Dropdown styling refined -->
            <div class="flex gap-4 mt-4 md:mt-0">
                <!-- Dropdown Semester (Updated Options) -->
                <div class="relative">
                    <select class="appearance-none bg-white border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 text-sm">
                        <option value="">Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                <!-- Dropdown Tahun -->
                <div class="relative">
                    <select class="appearance-none bg-white border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 text-sm">
                        <option value="">Tahun</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Cards + Pie Chart (Combined Row - using 4 columns) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            
            <!-- 1. Total Mata Kuliah (Blue/Purple) -->
            <div class="bg-[#4F46E5] text-white rounded-xl shadow-lg p-6 flex flex-col justify-between h-40">
                <h2 class="text-5xl font-extrabold">320</h2>
                <p class="text-base font-medium leading-snug opacity-90">Total Mata <br> Kuliah</p>
            </div>
            
            <!-- 2. Project Based Learning (Orange/Yellow) -->
            <div class="bg-[#F59E0B] text-white rounded-xl shadow-lg p-6 flex flex-col justify-between h-40">
                <h2 class="text-5xl font-extrabold">200</h2>
                <p class="text-base font-medium leading-snug opacity-90">Project Based <br> Learning (PJBL)</p>
            </div>
            
            <!-- 3. Case Based Method (Teal/Cyan) -->
            <div class="bg-[#14B8A6] text-white rounded-xl shadow-lg p-6 flex flex-col justify-between h-40">
                <h2 class="text-5xl font-extrabold">120</h2>
                <p class="text-base font-medium leading-snug opacity-90">Case Based <br> Method (CBM)</p>
            </div>

            <!-- 4. Pie Chart Panel (Uses 1 column) -->
            <div class="bg-white rounded-xl shadow-lg p-4 flex items-center justify-center h-40"> 
                <!-- Inner container to manage chart size and centering -->
                <div class="w-full h-full p-2">
                     <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bar Chart Section (Full Width) -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Presentase Metode Pembelajaran Per Fakultas</h3>
            <div class="h-96">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // --- CHART CONFIGURATION ---
    
    // Define the colors based on the image: PJBL (Orange), CBM (Teal)
    const COLOR_PJBL = '#F59E0B'; // Orange
    const COLOR_CBM = '#14B8A6'; // Teal
    
    // 1. Pie Chart: Distributions
    const pieCtx = document.getElementById('pieChart');
    
    new Chart(pieCtx, {
        type: 'doughnut', 
        data: {
            // Updated labels for better legend representation
            labels: ['PJBL', 'CBM'],
            datasets: [{
                data: [62.5, 37.5], 
                backgroundColor: [COLOR_PJBL, COLOR_CBM],
                hoverOffset: 10,
                borderWidth: 0, 
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'right', // Place legend on the right side
                    labels: {
                        boxWidth: 15,
                        padding: 10
                    }
                },
                tooltip: {
                    callbacks: {
                        // Display percentage labels inside the chart, matching the image
                        label: function(context) {
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            }
        },
        // Custom plugin to draw percentage labels directly on the chart (like the image)
        plugins: [{
            id: 'percentageLabel',
            afterDraw(chart) {
                const { ctx, data } = chart;
                ctx.save();
                
                data.datasets[0].data.forEach((value, index) => {
                    const meta = chart.getDatasetMeta(0);
                    const element = meta.data[index];
                    
                    const { x, y } = element.tooltipPosition();
                    
                    // Calculate angle for text positioning (middle of the slice)
                    const angle = (element.startAngle + element.endAngle) / 2;
                    // Slightly reduce radius to place text inside the donut hole
                    const radius = element.outerRadius * 0.7; 
                    
                    // Text coordinates
                    const textX = x + Math.cos(angle) * radius;
                    const textY = y + Math.sin(angle) * radius;
                    
                    // Set style
                    ctx.fillStyle = '#fff'; // White text for visibility
                    ctx.font = 'bold 16px sans-serif';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    
                    // Draw the percentage
                    ctx.fillText(`${value}%`, textX, textY);
                });
                ctx.restore();
            }
        }]
    });

    // 2. Bar Chart: Faculty Distribution
    const barCtx = document.getElementById('barChart');
    
    // Dummy labels and data to match the density and structure of the image
    const facultyLabels = ['FAPERTA', 'FATERNA', 'FAYETA', 'FEB', 'FH', 'FISIP', 'FK', 'FKG', 'FKM', 'FFARM', 'FMIPA', 'FT', 'FTI', 'PPS'];
    
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [
                {
                    label: 'PJBL', // Orange
                    data: [80, 45, 65, 88, 15, 55, 90, 35, 35, 95, 20, 40, 30, 93],
                    backgroundColor: COLOR_PJBL,
                    borderRadius: 4,
                },
                {
                    label: 'CBM', // Teal
                    data: [40, 55, 40, 30, 25, 75, 45, 70, 70, 30, 85, 60, 20, 15],
                    backgroundColor: COLOR_CBM,
                    borderRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { display: false } // Cleaner look
                },
                y: { 
                    beginAtZero: true, 
                    max: 100, 
                    ticks: {
                        stepSize: 20 // Added steps to match image more closely
                    }
                }
            },
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                         boxWidth: 15,
                         padding: 20
                    }
                }
            }
        }
    });
</script>
@endsection