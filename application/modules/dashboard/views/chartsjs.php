<script type="text/javascript">
  Highcharts.setOptions({
    colors: ['#A1D066', '#FF9655', '#adb5bd', '#FF9655', '#FFF263', '#6AF9C4']
  });

  function renderGraph(data) {

    Highcharts.chart('record_breakdown', {


      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
      },
      title: {
        text: 'Health Worker Breakdown By Category'
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
          }
        }
      },

      series: [{
        name: 'Health Worker Types',
        colorByPoint: true,
        filter: {
          property: 'percentage',
          operator: '>',
          value: 4
        },

        data: [{
            name: 'Verified VHT',
            y: data.chwdata_verified,
            sliced: true,
            selected: true
          },
          {
            name: 'Verified Facility Based HWs',
            y: data.mhwdata_verified
          },
          {
            name: 'Other Categories(LCs etc.)',
            y: data.others_verified_data
          }
        ]
      }],
      credits: {
        enabled: false
      }

    });
    //console.log(data.mhwdata);
  }

  //get dashboard Data
  $(document).ready(function() {
    //  renderGraph(data);


    $.ajax({
      type: 'GET',
      url: '<?php echo base_url('dashboard/dashboardData') ?>',
      dataType: "json",
      data: '',
      success: function(data) {

        $('#total_records').text(data.total_records);
        $('#total_verified').text(data.total_verified);
        $('#chwdata_verified').text(data.chwdata_verified);
        $('#mhwdata_verified').text(data.mhwdata_verified);
        $('#others_verified_data').text(data.others_verified_data);

        renderGraph(data);



      }

    });

  });
  ///data by MNOS
  function enrollment_column_graph(gdata) {

    Highcharts.chart('enrollment', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Enrollment by District'
      },
      subtitle: {
        text: 'Source: <a href="<?php echo base_url() ?>" target="_blank">Digital Finance Data Bank</a>'
      },
      xAxis: {
        type: 'category',
        labels: {
          rotation: -45,
          style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
          }
        }
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Enrollment'
        }
      },
      legend: {
        enabled: false
      },
      tooltip: {
        pointFormat: 'Enrollment: <b>{point.y:.1f} </b>'
      },
      credits: {
        enabled: false
      },
      series: [{
        name: 'Enrollment',
        data: gdata,
        dataLabels: {
          enabled: true,
          rotation: -90,
          color: '#FFFFFF',
          align: 'right',
          format: '{point.y:.1f}', // one decimal
          y: 10, // 10 pixels down from the top
          style: {
            fontSize: '13px',
            fontFamily: 'Verdana, sans-serif'
          }
        }
      }]
    });
  }


  ///data by MNOS


  function data_status_column_graph(gdata) {

    // Set up the chart
    const chart = new Highcharts.Chart({
      chart: {
        renderTo: 'data_status',
        type: 'column',
        options3d: {
          enabled: true,
          alpha: 15,
          beta: 15,
          depth: 50,
          viewDistance: 25
        }
      },
      xAxis: {
        categories: gdata.keys
      },
      yAxis: {
        title: {
          enabled: false
        }
      },
      tooltip: {
        headerFormat: '<b>{point.key}</b><br>',
        pointFormat: 'Records: {point.y}'
      },
      title: {
        text: 'Data Status'
      },
      subtitle: {
        text: 'Source: ' +
          '<a href="<?php echo base_url() ?>"' +
          'target="_blank">Digital Finance Databank</a>'
      },
      legend: {
        enabled: false
      },
      plotOptions: {
        column: {
          depth: 25
        }
      },
      series: [{
        data: gdata.values,
        colorByPoint: true
      }],
      credits: {
        enabled: false
      }
    });



    // Activate the sliders
    document.querySelectorAll('#sliders input').forEach(input => input.addEventListener('input', e => {
      chart.options.chart.options3d[e.target.id] = parseFloat(e.target.value);
      showValues();
      chart.redraw(false);
    }));

    showValues();
  }

  function showValues() {
    document.getElementById('alpha-value').innerHTML = chart.options.chart.options3d.alpha;
    document.getElementById('beta-value').innerHTML = chart.options.chart.options3d.beta;
    document.getElementById('depth-value').innerHTML = chart.options.chart.options3d.depth;
  }
  ///data by MNOS
  function mnodataGraph(data) {

    Highcharts.chart('enrollment_by_mno', {


      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
      },
      title: {
        text: 'Verified Data by Network Operators'
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      accessibility: {
        point: {
          valueSuffix: '%'
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
          }
        }
      },

      series: [{
        name: 'Operators',
        colorByPoint: true,

        data: [{
            name: 'MTN',
            y: data.mtn_verified,
            sliced: true,
            selected: true
          }, {
            name: 'Airtel',
            y: data.airtel_verified
          },
          {
            name: 'Others',
            y: data.others_verified
          }
        ]
      }],
      credits: {
        enabled: false
      }

    });
  }
  //console.log(data.mhwdata);

  //get dashboard Data
  $(document).ready(function() {
    //  renderGraph(data);


    $.ajax({
      type: 'GET',
      url: '<?php echo base_url('dashboard/mnodashboardData') ?>',
      dataType: "json",
      data: '',
      success: function(data) {
        $('#mtn_verified').text(data.mtn_verified);
        $('#airtel_verified').text(data.airtel_verified);
        $('#others_verified').text(data.others_verified);
        //console.log(data);
        mnodataGraph(data);
      }

    });
  });

  $(document).ready(function() {

    $.ajax({
      type: 'GET',
      url: '<?php echo base_url('dashboard/not_verified') ?>',
      dataType: "json",
      data: '',
      success: function(data) {
        $('#chwdata_not_verified').text(data.chwdata_not_verified);
        $('#mhwdata_not_verified').text(data.mhwdata_not_verified);
        $('#others_not_verified').text(data.others_not_verified);
        $('#covered_districts').text(data.covered_districts);
        $('#covered_facilities').text(data.covered_facilities);

      }

    });

  });

  $(document).ready(function() {

    $('#enrolloader').html('<img id="enrolloader" src="<?php echo base_url() ?>assets/images/loader.gif" />');

    $.ajax({
      type: 'GET',
      url: '<?php echo base_url('dashboard/get_enrollments') ?>',
      dataType: "json",
      data: '',
      success: function(data) {
        $('#enrolloader').hide();
        enrollment_column_graph(data);
      }

    });

  });

  $(document).ready(function() {

    $.ajax({
      type: 'GET',
      url: '<?php echo base_url('dashboard/data_status') ?>',
      dataType: "json",
      data: '',
      success: function(data) {
        data_status_column_graph(data);
        // console.log(data.keys);

      }

    });

  });

  //get data for districts
  var app = new Vue({
    el: '#app',
    data: {
      districts: "",

    },
    mounted: function() {

      this.dists()

    },
    methods: {
      dists: function() {

        axios.get('<?php echo base_url() ?>dashboard/kyc_verified_table')
          .then(function(response) {
            app.districts = response.data;
            // console.log(response.data);
            setTimeout(() => {
              $('#vuedata_table').DataTable(

                {
                  dom: 'Bfrtip',
                  "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false,
                  "responsive": true,
                  lengthMenu: [
                    [10, 20, 30, 150, -1],
                    ['10', '20', '40', '50', '150', 'Show all']
                  ],

                  buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pageLength',


                  ]
                }

              );
            }, 0);

          })
          .catch(function(error) {
            console.log(error);
          });
      },


    }
  })
</script>