<canvas id="myAreaChart"></canvas>
<?php

$dada = [];
$q = $this->Sales_model->get_data($this->session->userdata('user')->id_user);
$res = $q->result();
foreach ($res as $row) {
    $dada[$row->kode_barang] = $row->nama_barang;
}
//print_pre($dada);

$sql1 = "SELECT
           DATE(a.tgl_order) AS tgl_order
        FROM sales_order a
        JOIN sales_order_detail b ON a.id_transaksi = b.id_transaksi
        JOIN barang c ON c.kode_barang = b.kode_barang
        WHERE a.id_user = ".$this->session->userdata('user')->id_user."
        $sql
        GROUP BY DATE(a.tgl_order)
        ORDER BY DATE(a.tgl_order)";
//echo $sql1;
$q = $this->db->query($sql1);
$res = $q->result();
$label = [];
$jml = [];
$tmp_kode = "";
foreach ($res as $row) {
    $tgl = date("d-m-Y", strtotime($row->tgl_order));
    $tgl2 = date("Y-m-d", strtotime($row->tgl_order));
    $label[$tgl] = $tgl;
    foreach ($dada as $k => $va) {
        $sql = "SELECT 
               a.id_user,
               b.kode_barang,
               c.nama_barang,
               DATE(a.tgl_order) AS tgl_order,
               SUM(b.jumlah_order) AS jumlah_order
            FROM sales_order a
            JOIN sales_order_detail b ON a.id_transaksi = b.id_transaksi
            JOIN barang c ON c.kode_barang = b.kode_barang
            WHERE a.id_user = ".$this->session->userdata('user')->id_user."
            AND DATE(a.tgl_order) = '$tgl2' AND b.kode_barang = '$k'
            GROUP BY b.kode_barang, DATE(a.tgl_order)
            ORDER BY b.kode_barang, DATE(a.tgl_order)";
        $qq = $this->db->query($sql);
        $ress = $qq->result();
        if($qq->num_rows()>0){
            foreach ($ress as $roww) {
                $jml[$k][$tgl] = $roww->jumlah_order;
            }
        }else{
            $jml[$k][$tgl] = 0;
        }
    }
}
/*
print_pre($label);
print_pre($jml);
print_pre($dada);
*/

$color = ['red','orange','yellow','green','blue','purple','grey', 'black'];
$datasets = [];
$i=0;
if(!empty($jml)){

    foreach ($dada as $key => $value) {
        $ret = '{';
        $ret .= 'label:"'.$value.'",';
        $ret .= 'backgroundColor:window.chartColors.'.$color[$i].','."\n";
        $ret .= 'borderColor:window.chartColors.'.$color[$i].','."\n";
        $ret .= 'data:['.join(', ', $jml[$key]).'],'."\n";
        $ret .= 'fill:false,'."\n";

        $ret .= '}';
        $i++;
        if($i>sizeof($color)-1){
            $i=0;
        }
        $datasets[] = $ret;
    }
}
//print_pre($datasets);
?>
<script type="text/javascript">
        

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["<?= join('", "', $label) ?>"],
        datasets: [<?= join(", ", $datasets); ?>],
    },
    options: {
        maintainAspectRatio: false,
        title:{
            display: true,
            text: '<?= $judul; ?>',
            fontSize: 20
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 0,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: true,
                    drawBorder: true
                },
                ticks: {
                    maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: true,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        legend: {
            display: true,
            position: 'bottom'
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                }
            }
        }
    }
});





</script>