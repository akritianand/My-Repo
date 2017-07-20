$(document).ready(function() {
    $('#MONTH').hide();
    $('#DATE').hide();
    $('#TICKET').hide();
    $('#STATION').hide();
    $('#MAINSTAFF').hide();
    $('#TODAY').hide();
    $('#OPEN').hide();

    $('#place1').submit (function (event) {
            event.preventDefault();
            $('#MONTH').show();
            $('#DATE').hide();
            $('#TICKET').hide();
            $('#STATION').hide();
            $('#MAINSTAFF').hide();
            $('#TODAY').hide();
            $('#OPEN').hide();

            $.ajax({
                type: "POST",
                url: "mainsetrackjobsubmit.php",
                data: $(this).serialize(), 
                success: function(response) {
                    $("#responsecontainer1").html(response);
                    $("#mname").html($("#month option:selected").text());
                },                  
                error: function() {
                   console.log('not working');
                }
            });    
        });    

        $('#place2').submit (function (event) {
            event.preventDefault();
            $('#DATE').show();
            $('#MONTH').hide();
            $('#TICKET').hide();
            $('#STATION').hide();
            $('#MAINSTAFF').hide();
            $('#TODAY').hide();
            $('#OPEN').hide();
               
            $.ajax({
                type: "POST",
                url: "mainsetrackjobsubmit.php",
                data: $(this).serialize(), 
                success: function(response) {
                    $("#responsecontainer2").html(response);
                    var date = $("#sdate").val() + " to " + $("#fdate").val();
                    $("#dname").html(date);

                    console.log('working');
                },                  
                error: function() {
                   console.log('not working');
                }
            });    
        });  

        $('#place3').submit (function (event) {
            event.preventDefault();
            $('#TICKET').show();
            $('#MONTH').hide();
            $('#DATE').hide();
            $('#STATION').hide();
            $('#MAINSTAFF').hide();
            $('#TODAY').hide();
            $('#OPEN').hide();
            
            $.ajax({
                type: "POST",
                url: "mainsetrackjobsubmit.php",
                data: $(this).serialize(), 
                success: function(response) {
                    $("#responsecontainer3").html(response);
                    $("#tname").html($("#ticketid").val());
                    console.log('working');
                },                  
                error: function() {
                   console.log('not working');
                }
            });    
        });

        $('#place4').submit (function (event) {
            event.preventDefault();
            $('#TICKET').hide();
            $('#MONTH').hide();
            $('#DATE').hide();
            $('#STATION').show();
            $('#MAINSTAFF').hide();
            $('#TODAY').hide();
            $('#OPEN').hide();
            
            $.ajax({
                type: "POST",
                url: "mainsetrackjobsubmit.php",
                data: $(this).serialize(), 
                success: function(response) {
                    $("#responsecontainer4").html(response);
                    $("#stname").html($("#responsecontainer option:selected").text());
                    console.log('working');
                },                  
                error: function() {
                   console.log('not working');
                }
            });    
        });

        $('#place5').submit (function (event) {
            event.preventDefault();
            $('#TICKET').hide();
            $('#MONTH').hide();
            $('#DATE').hide();
            $('#STATION').hide();
            $('#MAINSTAFF').show();
            $('#TODAY').hide();
            $('#OPEN').hide();
            
            $.ajax({
                type: "POST",
                url: "mainsetrackjobsubmit.php",
                data: $(this).serialize(), 
                success: function(response) {
                    $("#responsecontainer5").html(response);
                    $("#mainname").html($("#mainstaff").val());
                    console.log($("#mainstaff").val());
                },                  
                error: function() {
                   console.log('not working');
                }
            });    
        });

        $('#jobtoday').click(function(event) {
            event.preventDefault();
            $('#TICKET').hide();
            $('#MONTH').hide();
            $('#DATE').hide();
            $('#STATION').hide();
            $('#MAINSTAFF').hide();
            $('#TODAY').show();
            $('#OPEN').hide();

            $.ajax({
            type: "GET",
            url: "mainsetrackjobsubmit.php?type=jobtoday",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer6").html(response);
                console.log('working');
            },                  
            error: function() {
                console.log('not working'); 
            }
            });
        }); 

        $('#openjob').click(function(event) {
            event.preventDefault();
            $('#TICKET').hide();
            $('#MONTH').hide();
            $('#DATE').hide();
            $('#STATION').hide();
            $('#MAINSTAFF').hide();
            $('#TODAY').hide();
            $('#OPEN').show();

            $.ajax({
            type: "GET",
            url: "mainsetrackjobsubmit.php?type=openjob",             
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer7").html(response); 
            },                  
            error: function() {
                console.log('not working'); 
            }
            });   
        });

        $("#lineinput").on("change", function() {
        $("#secinput").on("change paste", function() {
          var line = $('#lineinput').val();
          var sec = $('#secinput').val();

          $.ajax({
            type: "POST",
            url: "opstat.php", 
            data: {'line':line, 'sec':sec},            
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer").html(response); 
            } 
          });
        });
      });
 
    function exportTableToCSV($table, filename) {
 
        var $rows = $table.find('tr:has(td),tr:has(th)'),
 
            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character
 
            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',
 
            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td, th');
 
                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();
 
                    return text.replace('"', '""'); // escape double quotes
 
                }).get().join(tmpColDelim);
 
            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',
 
            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
 
        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }
 
    // This must be a hyperlink
    $("#export1").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData1>table'), 'Reports.xls']);  //Change name of excel as per your need
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
    $("#export2").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData2>table'), 'Reports.xls']);  //Change name of excel as per your need
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
    $("#export3").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData3>table'), 'Reports.xls']);  //Change name of excel as per your need
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
    $("#export4").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData4>table'), 'Reports.xls']);  //Change name of excel as per your need
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
    $("#export5").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData5>table'), 'Reports.xls']);  //Change name of excel as per your need
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
    $("#export6").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData6>table'), 'Reports.xls']);  //Change name of excel as per your need
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
    $("#export7").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData7>table'), 'Reports.xls']);  //Change name of excel as per your need
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});	
