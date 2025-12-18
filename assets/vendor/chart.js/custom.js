import * as echarts from 'echarts';

const chartDom = document.getElementById('ChartSiswa');
const myChart = echarts.init(chartDom);

const option = {
    title: {
        text: 'Jumlah Siswa Izin per Hari',
        left: 'center'
    },
    tooltip: {
        trigger: 'axis'
    },
    xAxis: {
        type: 'category',
        data: izinChartData.map(item => item[0])
    },
    yAxis: {
        type: 'value',
        minInterval: 1
    },
    series: [{
        name: 'Jumlah Izin',
        type: 'line',
        smooth: true,
        data: izinChartData.map(item => item[1]),
        areaStyle: {},
        lineStyle: {
            width: 3
        }
    }]
};

myChart.setOption(option);

// Responsif
window.addEventListener('resize', () => {
    myChart.resize();
});
