<script>
    $(function () {
        "use strict";
        // ------------------------------
        // Basic pie chart
        // ------------------------------
        // based on prepared DOM, initialize echarts instance
        var chartJenis = echarts.init(document.getElementById('pie-jenis'));
        var option = {
            // Add title
            title: {
                text: 'Kasus Berdasarkan Jenis',
                x: 'center'
            },

            // Add tooltip
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },

            // Add legend
            legend: {
                orient: 'vertical',
                x: 'left',
                data: ['KNC', 'KTC', 'KTD', 'KPC']
            },

            // Add custom colors
            color: ['#689f38', '#389f99', '#ee1044', '#ff8f00'],

            // Display toolbox
            toolbox: {
                show: true,
                orient: 'vertical',
                feature: {
                    mark: {
                        show: true,
                        title: {
                            mark: 'Markline switch',
                            markUndo: 'Undo markline',
                            markClear: 'Clear markline'
                        }
                    },
                    magicType: {
                        show: true,
                        title: {
                            pie: 'Switch to pies',
                            funnel: 'Switch to funnel',
                        },
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '25%',
                                y: '20%',
                                width: '50%',
                                height: '70%',
                                funnelAlign: 'left',
                                max: 1548
                            }
                        }
                    },
                    saveAsImage: {
                        show: true,
                        title: 'Same as image',
                        lang: ['Save']
                    }
                }
            },

            // Enable drag recalculate
            calculable: true,

            // Add series
            series: [{
                name: 'Kasus berdasarkan Jenis',
                type: 'pie',
                radius: '70%',
                center: ['50%', '57.5%'],
                data: [{
                        value: @json($jumlahKNC),
                        name: 'KNC'
                    },
                    {
                        value: @json($jumlahKTC),
                        name: 'KTC'
                    },
                    {
                        value: @json($jumlahKTD),
                        name: 'KTD'
                    },
                    {
                        value: @json($jumlahKPC),
                        name: 'KPC'
                    }
                ]
            }]
        };

        chartJenis.setOption(option);

        $(function () {

            // Resize chart on menu width change and window resize
            $(window).on('resize', resize);
            $(".sidebartoggler").on('click', resize);

            // Resize function
            function resize() {
                setTimeout(function () {

                    // Resize chart
                    chartJenis.resize();
                }, 200);
            }
        });

        var chartGrading = echarts.init(document.getElementById('pie-grading'));
        var option = {
            // Add title
            title: {
                text: 'Kasus Berdasarkan Grading',
                x: 'center'
            },

            // Add tooltip
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },

            // Add legend
            legend: {
                orient: 'vertical',
                x: 'left',
                data: ['Biru', 'Hijau', 'Kuning', 'Merah']
            },

            // Add custom colors
            color: ['#389f99', '#689f38', '#ff8f00', '#ee1044'],

            // Display toolbox
            toolbox: {
                show: true,
                orient: 'vertical',
                feature: {
                    mark: {
                        show: true,
                        title: {
                            mark: 'Markline switch',
                            markUndo: 'Undo markline',
                            markClear: 'Clear markline'
                        }
                    },
                    magicType: {
                        show: true,
                        title: {
                            pie: 'Switch to pies',
                            funnel: 'Switch to funnel',
                        },
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '25%',
                                y: '20%',
                                width: '50%',
                                height: '70%',
                                funnelAlign: 'left',
                                max: 1548
                            }
                        }
                    },
                    saveAsImage: {
                        show: true,
                        title: 'Same as image',
                        lang: ['Save']
                    }
                }
            },

            // Enable drag recalculate
            calculable: true,

            // Add series
            series: [{
                name: 'Kasus berdasarkan Jenis',
                type: 'pie',
                radius: '70%',
                center: ['50%', '57.5%'],
                data: [{
                        value: @json($gradeBiru),
                        name: 'Biru'
                    },
                    {
                        value: @json($gradeHijau),
                        name: 'Hijau'
                    },
                    {
                        value: @json($gradeKuning),
                        name: 'Kuning'
                    },
                    {
                        value: @json($gradeMerah),
                        name: 'Merah'
                    }
                ]
            }]
        };

        chartGrading.setOption(option);

        $(function () {

            // Resize chart on menu width change and window resize
            $(window).on('resize', resize);
            $(".sidebartoggler").on('click', resize);

            // Resize function
            function resize() {
                setTimeout(function () {

                    // Resize chart
                    chartGrading.resize();
                }, 200);
            }
        });
    });

</script>
