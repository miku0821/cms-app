<x-admin-master>
    @section('content')
        
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        <a href="{{route('admin.index')}}#disqus_thread"></a>
        <canvas id="myChart"></canvas>
        
        @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Posts', 'Comments', 'Users'],
                    datasets: [{
                        label: 'Data of CMS',
                        data: [{{$postsCount}}, {{$commentsCount}}, {{$usersCount}}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            </script>
    
        @endsection
        @section('scripts')
        <script id="dsq-count-scr" src="//http-127-0-0-1-8000-0zodgyxso2.disqus.com/count.js" async></script>
            <script id="dsq-count-scr" scr="//http-127-0-0-1-8000-0zodgyxso2.disqus.com/count.js" async></script>
        @endsection
    @endsection
</x-admin-master>