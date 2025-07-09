function columnChart({id, type, series, categories, byField, title, backgroundColor, fontColor, legend}) {
    Highcharts.chart(id, {
        chart: {
            type: type,
            backgroundColor: backgroundColor,
            options3d: {
                enabled: false,
                alpha: 45,
                beta: 0,
                depth: 100 
            }
        },
        title: {
            text: title,
            marginTop: '20px',
            marginBottom: '10px',
            style: {
                color: fontColor
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><br/>',
            pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br/>'
        },
        xAxis: {
            categories: categories.map((category) => category[byField]), // Menggunakan hanya status sebagai kategori
            title: {
                text: null,
            },
            labels: {
                style: {
                    fontWeight: '600',
                    color: fontColor,
                },
            },
        },

        credits: {
            enabled: false,
        },
        accessibility: {
            point: {
                valueSuffix: '%',
            },
        },

        plotOptions: {
            column: {
                dataLabels: {
                    enabled: legend
                },
                cursor: 'pointer',
                showInLegend: legend,
            }
        },
        
        yAxis: {
            title: {
                text: null,
                style: {
                    color: fontColor,
                },
            },
            labels: {
                style: {
                    fontWeight: '600',
                    color: fontColor,
                },
            },
        },
        legend: {
            enabled: legend,
            itemStyle: {
                color: fontColor,
                fontWeight: '600',
            },
        },
        series: [{
            name: '',
            colorByPoint: true,
            data: series,
        }],
    });
}

function onClickColumnChart({id, type , content, series, categories, byField, title, backgroundColor, fontColor, legend}) {
    Highcharts.chart(id, {
        chart: {
            type: type,
            backgroundColor: backgroundColor,
            options3d: {
                enabled: false,
                alpha: 45,
                beta: 0,
                depth: 100 
            }
        },
        title: {
            text: title,
            marginTop: '20px',
            marginBottom: '10px',
            style: {
                color: fontColor
            }
        },

        xAxis: {
            categories: categories.map((category) => category[byField]), // Menggunakan hanya status sebagai kategori
            title: {
                text: null,
            },
            labels: {
                style: {
                    color: fontColor,
                },
            },
        },

        credits: {
            enabled: false,
        },
        accessibility: {
            point: {
                valueSuffix: '%',
            },
        },

        plotOptions: {
            column: {
                dataLabels: {
                    enabled: true
                },
                groupPadding: 0,
                allowPointSelect: true,
                cursor: 'pointer',
                showInLegend: legend,
                events: content
            }
        },
        
        yAxis: {
            title: {
                text: null,
                style: {
                    color: fontColor,
                },
            },
            labels: {
                style: {
                    color: fontColor,
                },
            },
        },
        legend: {
            enabled: legend,
            itemStyle: {
                color: fontColor,
            },
        },
        series: [{
            name: '',
            colorByPoint: true,
            data: series,
        }],
    });
}

function pieChart({id, type ,series, categories, byField,title, backgroundColor, fontColor, legend}) {
    Highcharts.chart(id, {
        chart: {
            type: type,
            backgroundColor: backgroundColor,
            options3d: {
                enabled: false,
                alpha: 45,
                beta: 0,
                depth: 100 
            }
        },
        title: {
            text: title,
            marginTop: '20px',
            marginBottom: '10px',
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><br/>',
            pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y}</b><br/>'
        },
        xAxis: {
            categories: categories.map((category) => category[byField]), // Menggunakan hanya status sebagai kategori
            title: {
            text: null,
            },
            labels: {
            style: {
                    fontWeight: '600',
                    color: fontColor,
                },
            },
        },

        credits: {
            enabled: false,
        },
        accessibility: {
            point: {
                valueSuffix: '%',
            },
        },

        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                showInLegend: legend,
            },
            series: {
                allowPointSelect: true,
                depth: 35,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    distance: 15,
                    format: '{point.name} ({point.percentage:.1f}%)',
                    style: {
                        fontSize: '0.7em',
                        color: fontColor,
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 1
                    }
                },
            }
        },

        yAxis: {
            title: {
            text: null,
            style: {
                color: fontColor,
            },
            },
            labels: {
                style: {
                    fontWeight: '600',
                    color: fontColor,
                },
            },
        },
        legend: {
            enabled: legend,
            itemStyle: {
                color: fontColor,
                fontWeight: '600',
            },
        },
        series: [{
            name: '',
            colorByPoint: true,
            data: series,
        }],
    });
}



// calling chart...
function getColorByFieldName(namaBidang, colorMapping) {
    return colorMapping[namaBidang] || 'rgb(70, 184, 255)'; // Jika tidak ada, beri warna default
}

function prepareChartData(data, byField, colorMapping = {}) {
    return data.map((field) => ({
        name: field[byField],
        y: field.val,
        color: getColorByFieldName(field.status, colorMapping),
    }));
}

function callColumnChart({ data, byField, chartId, title, backgroundColor, fontColor, colorMapping = {} }) {
        
    const dataSeries = prepareChartData(data, byField, colorMapping);

    columnChart({
        id: chartId,
        type: 'column',
        series: dataSeries,
        categories: data,
        byField: byField,
        title: title,
        backgroundColor: backgroundColor,
        fontColor: fontColor,
        legend: false,
    });
}

function callOnClickColumnChart({ data, content, byField, chartId, title, backgroundColor, fontColor, colorMapping = {} }) {
        
    const dataSeries = prepareChartData(data, byField, colorMapping);

    onClickColumnChart({
        id: chartId,
        type: 'column',
        content: content,
        series: dataSeries,
        categories: data,
        byField: byField,
        title: title,
        backgroundColor: backgroundColor,
        fontColor: fontColor,
        legend: false,
    });
}

function callPieChart({ data, byField, chartId, title, backgroundColor, fontColor, colorMapping = {} }) {
    const dataSeries = prepareChartData(data, byField, colorMapping);

    pieChart({
        id: chartId,
        type: 'pie',
        series: dataSeries,
        categories: data,
        byField: byField,
        title: title,
        backgroundColor: backgroundColor,
        fontColor: fontColor,
        legend: false,
    });
}