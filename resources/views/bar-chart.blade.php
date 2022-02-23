<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Title</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"
            integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>

    <body>
        <div style="height:400px; width:900px;margin:auto">
            <canvas id="barChart"></canvas>
        </div>
        <script>
        $(function() {
            var datas = <?php echo json_encode($datas); ?>;
            var days = <?php echo json_encode($days); ?>;
            var barCanvas = $("#barChart");
            var barChart = new Chart(barCanvas, {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [{
                        label: 'Posts 2022',
                        data: datas,
                        backgroundColor: ['red', 'orange', 'yellow', 'green', 'blue', 'indigo',
                            'pink',

                        ]
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        })
        </script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js">
        </script>
    </body>

</html>
