<!-- Dashboard -->
<div class="dashboard__wrapper">
    <!-- <div class="grid__row dashboard__header">
        <div class="dashboard__item-wrapper">
            <p class="dashboard__item-number">
                111
                <span class="dashboard__item-name">
                    Register User
                </span>
            </p>
            <i class="dashboard__item-icon fa-regular fa-file"></i>
        </div>
        <div class="dashboard__item-wrapper">
            <p class="dashboard__item-number">
                811
                <span class="dashboard__item-name">
                    Daily Visitors
                </span>
            </p>
            <i class="dashboard__item-icon fa-regular fa-eye"></i>
        </div>
        <div class="dashboard__item-wrapper">
            <p class="dashboard__item-number">
                231
                <span class="dashboard__item-name">
                    Daily Orders
                </span>
            </p>
            <i class="dashboard__item-icon fa-solid fa-cart-shopping"></i>
        </div>
    </div> -->
    <div class="grid__row dashboard__body">
        <div class="dashboard__chart-wrapper grid__col-10">
            <p class="dashboard__chart-header">Thống kê theo: <span id="text-date"></span></p>
            <p>
                <select class="select-date">
                    <option value="">-- Chọn thống kê --</option>
                    <option value="7days">7 ngày qua</option>
                    <option value="28days">28 ngày qua</option>
                    <option value="90days">90 ngày qua</option>
                    <option value="365days">365 ngày qua</option>
                </select>
            </p>
            <div class="dashboard__chart">
                <h1 class="dashboard__chart-header">REVENUE GROWTH CHART</h1>
                <!-- Chart -->
                <div id="chartRevenue" style="height: 250px; width: 100%"></div>
            </div>
            <div class="dashboard__chart">
                <h1 class="dashboard__chart-header">QUANTITY OF PRODUCT BY CATEGORY CHART</h1>
                <!-- Chart -->
                <div id="chartDish" style="height: 250px; width: 100%"></div>
            </div>
        </div>
        <div class="dashboard__total-wrapper grid__col-2">
            <div class="dashboard__total">
                <h1 class="dashboard__total-header">TOTAL REVENUE</h1>
                <p class="dashboard__total-number yellow-color price">
                <?php 
                    $sql_total = "SELECT SUM(orderTotal) as Total FROM tbl_order WHERE orderStatus = 'Finished'";
                    $query_total = mysqli_query($mysqli, $sql_total);
                    $result_total = mysqli_fetch_assoc($query_total);
                    echo $result_total['Total'];
                ?>
                </p>
            </div>
            <!-- <div class="dashboard__total">
                <h1 class="dashboard__total-header">REVENUE GROWTH</h1>
                <p class="dashboard__total-number red-color">-3%</p>
            </div> -->
        </div>
    </div>
</div>
<!-- End of Dashboard -->

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
    $(document).ready(function() {
        formatNumber();
        firstLoad();
        var chartRevenue = new Morris.Line({
            element: 'chartRevenue',

            xkey: 'time',

            ykeys: ['value'],

            labels: ['Doanh thu']
        });

        var chartDish = new Morris.Bar({
            element: 'chartDish',

            xkey: 'name',

            ykeys: ['value'],

            labels: ['Số lượng'],
        });

        $('.select-date').change(function() {
            var time = $(this).val();
            if (time == '7days') {
                var text = '7 ngày qua';
            } else if (time == '28days') {
                var text = '28 ngày qua';
            } else if (time == '90days') {
                var text = '90 ngày qua';
            } else {
                var text = '365 ngày qua';
            }
            $.ajax({
                url: 'controller/controllerDashboard.php',
                method: 'POST',
                dataType: 'json',
                data: {time: time},
                success: function (data) {
                    $('#text-date').text(text);
                    chartRevenue.setData(data.chartRevenue);
                    chartDish.setData(data.chartDish);
                    $(window).resize(function() {
                        chartRevenue.redraw();
                        chartDish.redraw();;
                    });
                }
            })
        })

        function firstLoad() {
            var text = '365 ngày qua';
            $('#text-date').text(text);
            $.ajax({
                url: 'controller/controllerDashboard.php',
                method: 'POST',
                dataType: 'json',
                success: function (data) {
                    $('#text-date').text(text);
                    chartRevenue.setData(data.chartRevenue);
                    chartDish.setData(data.chartDish);
                    $(window).resize(function() {
                        chartRevenue.redraw();
                        chartDish.redraw();;
                    });
                }
            })
        }
    })
</script>