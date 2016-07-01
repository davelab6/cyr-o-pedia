 window.onload = function () { 
  
    // text marque
    
    $('#volkhov-regular').addClass('Volkhov-Italic');
    $('#lora-regular').addClass('Lora-Italic');
    
    function textin(object, i) {
      var valen = $(i).val().length;
      $('#search_query').val(valen);
      var indent = 1000 + i;
      //indent--;
    $(object).find('.font-input').animate({ 'text-indent': indent} ,1000)
    }

    function textout(object) {
      //var valen = $(this).val().length;
      //$('#search_query').val(valen);
      var indent = 0;
      //indent--;
    $(object).find('.font-input').animate({ 'text-indent': indent} ,500)
    }

    // fontpreview01
    $('section.fontpreview01').mouseenter(function() {      
        //$(this).find('input.font-input').addClass('fontpreviewhover');
        //movetext('input.font-input');
        var inp_len = $(this).find('input.font-input');
        textin(this, inp_len);
        $(this).find('section.fontinfo').removeClass('off');
        $(this).find('section.fontinfo').addClass('on');

        //$(this).find('.sizehandle').addClass('on');
    });    

   

    $('section.fontpreview01').mouseleave(function() {     
        //$(this).find('input.font-input').removeClass('fontpreviewhover');
        textout(this);
        $(this).find('section.fontinfo').addClass('off');
        $(this).find('section.fontinfo').removeClass('on');
      //.switchClass("Volkhov-Bold","Volkhov-Bold-Italic", 1000);
      
 //$( ".newClass" ).switchClass( "newClass", "anotherNewClass", 1000 );
      });



        //$(this).find('.sizehandle').removeClass('on');       

    // change input font samle font size
    var size1 = 150;
    var size2 = 42;
    var size3 = 220;
    var size4 = 80;
    var px = "px | ";

    $('.px_ord_0').html(size1 + px);
    $('.px_ord_1').html(size2 + px);
    $('.px_ord_2').html(size3 + px);
    $('.px_ord_3').html(size4 + px);

    $('input.irange_ord_0').val(size1);
    $('input.irange_ord_1').val(size2);
    $('input.irange_ord_2').val(size3);
    $('input.irange_ord_3').val(size4);

    // load text info font input   
    $.getJSON( "/cofont/site/templates/files/pangrams/pangrams.json", function( data ) {
      var items = [];
      $.each( data, function( key, val ) {
        items.push(val);
      });
      
      $('.font-input').each( function(y) {
      var randnums = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
      var m = Math.floor(Math.random()*randnums.length);
      //var x = Math.floor((Math.random() * 17)); // rand 0 - 16
        $(this).val(items[ randnums[m] ]);
        randnums = randnums.splice(m,1);
      });
      
      $('.fontpreview01').find('.font-input').not('#lobster-cyrillic-regular, #marmelad-regular, #lora-regular, #lora-bold').mouseleave( function(y) {     
      var randnums = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
      var m = Math.floor(Math.random()*randnums.length);
      //var x = Math.floor((Math.random() * 17)); // rand 0 - 16
        $(this).val(items[ randnums[m] ]);
        randnums = randnums.splice(m,1);
      });
    });

     // load text info font input for Cyrillic
    $.getJSON( "/cofont/site/templates/files/pangrams/pangrams-cyr.json", function( data ) {
      var items = [];
      $.each( data, function( key, val ) {
        //items.push( "<li id='" + key + "'>" + val + "</li>" );
        items.push(val);
      });
      
      $('.fontpreview01').find('#lobster-cyrillic-regular, #marmelad-regular, #lora-regular, #lora-bold, #baumans-regular').each( function(y) {
      var randnums = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24];
      var m = Math.floor(Math.random()*randnums.length);
      //var x = Math.floor((Math.random() * 17)); // rand 0 - 16
        $(this).val(items[ randnums[m] ]);
        randnums = randnums.splice(m,1);
      });

      // change cyrillic text on hover
      $('.fontpreview01').find('#lobster-cyrillic-regular, #marmelad-regular, #lora-regular, #lora-bold, #baumans-regular').mouseleave( function(y) {     
      var randnums = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
      var m = Math.floor(Math.random()*randnums.length);
      //var x = Math.floor((Math.random() * 17)); // rand 0 - 16
        $(this).val(items[ randnums[m] ]);
        //randnums = randnums.splice(m,1);
      });

    });

      


    // Toggle Language support 

    $('.toggle').next('dd').hide();                        
    
    $('#lat').click(function() {
        var txt = $(this).next('dd').is(':visible') ? 'Latin (53):' : 'Latin:';
        $(this).next('dd').slideToggle('5000');
        $(this).text(txt);
    });

    $('#cyr').click(function() {
        var txt = $(this).next('dd').is(':visible') ? 'Cyrillic (16):' : 'Cyrillic:';
        $(this).next('dd').slideToggle('5000');
        $("#cyr").text(txt);
    });

    // show size handle on mouseenter
    $('div.fontcontainer_out').mouseenter(function() {      
        $(this).find('div.fontcontainer').addClass('hover');
        $(this).find('.sizehandle').addClass('on');
    });    
    $('div.fontcontainer_out').mouseleave(function() {     
        $(this).find('div.fontcontainer').removeClass('hover');
        $(this).find('.sizehandle').removeClass('on');   
    });    
  
    // Change Font Sizes  
    $('.sizehandle').on("mousemove", function() {
          var x = this.value + 'px';        
          $(this).attr('title', x)
                 .tooltip('fixTitle')
                 .data('bs.tooltip')
                 .$tip.find('.tooltip-inner')
                 .text(x);
          $(this).closest('.row').find('.px').hide();
          $(this).closest('.row').find('.px').html(x + ' | ');// change px legend value in closest .px span
          $(this).closest('.fontcontainer').find('.font-input').css('font-size', x)   
                 .css('line-height', x);  

    });
    // Show font size next to font name on top left
    $('.sizehandle').on("mouseout", function() {
          $(this).closest('.row').find('.px').show();
    });
    
    // Radio buttons text change
    $('input[name="r1"]').click( function() {
        var r = this.value;
        $('.radio').css('font-size', r + 'px').css('line-height',r*1.3 + 'px'); 
    });

    // Select font change
    $( "#sel1" ).change( function () {
        var fontchange = this.value;
        $('.sel_font').css("font-family", fontchange);
      })

    // .webfont_check — change Google Fonts Style

/*
  
    $('#boxid').click(function() {
      if ($(this).is(':checked')) {
        $(this).siblings('label').html('checked');
      } else {
        $(this).siblings('label').html(' not checked');
      }
    });


*/ 
      
    // Change subset to Cyrillic
    $('#check_cyr').click(function() {
      if ($(this).is(':checked')) {
        // add cyr
        $('#subset_change').text('&subset=latin,cyrillic');
      } else {
        // remove cyr
        $('#subset_change').text('');
      }
    });
  
    // Output Selected styles
    $('.stylechange_group').change(function() {
        // get values from all checkboxes
        var checkedStyles = $('.stylechange_group:checkbox:checked').map(function() {
                return this.value;
            }).get();

    $('#styles_output').text(checkedStyles).prepend(':');

    if (!$('.stylechange_group').is(':checked')) {
      $('#styles_output').text('');
    }

    });
  
    
    // Font name cleaning
    var fontNames = $('.ptsize, option');
    fontNames.each(function(){
      $(this).html($(this).html().replace(/_/g, " ")
                                 .replace(/-/g, " ")
                                 .replace(/webfont/g, ""));
    });


      // toggleClass for jacques francois
      $('#jacques-francois-shadow-regular').mouseleave( function() {
        $(this).toggleClass('Jacques-Francois-Regular');
      });     

/*
      // toggleClass for Volkhov    
      $('#volkhov-regular').mouseleave(function() {                             
      this.className = {
         'Volkhov-Italic' : 'Volkhov-Bold', 'Volkhov-Bold': 'Volkhov-Bold-Italic', 'Volkhov-Bold-Italic': 'Volkhov-Regular', 'Volkhov-Regular': 'Volkhov-Italic'
      }[this.className];
      });


*/

      /*

      $('#volkhov-regular').mouseleave(function () {
        var classes = ['Volkhov-Italic','Volkhov-Bold','Volkhov-Bold-Italic', 'Volkhov-Regular'];
        var oldClass = $(this).attr('class');
        var newClasses = classes[($.inArray(this.className, classes)+1)%classes.length];
        $(this).className = oldClass + ' ' + newClasses;
        $(this).toggleClass(newClasses);
        //$('input').each(function(){
        //  var newClasses = classes[($.inArray(this.className, classes)+1)%classes.length];
          //this.className = {'Volkhov-Italic' : 'Volkhov-Bold'}[this.className];
          //$(this).addClass(oldClass + ' ' + newClasses);
          //$(this).addClass(newClasses);
         


        //});
        
      });

      */




}();

//var reset = $ ('input').css('fontsize');
  //$divElement = $('#row3 td div');        


 /*
    var file = "/cofont/site/templates/files/pangrams/pangrams.txt";
    function getFile(){
    $.get(file,function(txt){
        var lines = txt.responseText.split("\n");
        for (var i = 0, len = lines.length; i < len; i++) {
            save(lines[i]);
        }
    }); 
    
    */

    //test
    /*
    $('body').tooltip({
    delay: { show: 300, hide: 0 },
    placement: function(tip, element) { //$this is implicit
        var position = $(element).position();
        if (position.left > 515) {
            return "left";
        }
        if (position.left < 515) {
            return "right";
        }
        if (position.top < 110){
            return "bottom";
        }
        return "top";
    },
    selector: '[rel=tooltip]:not([disabled])'
    });

    */
    /*
    // Tooltip only Text
    $('.masterTooltip').hover(function(){
            // Hover over code
            var title = $(this).attr('title');
            $(this).data('tipText', title).removeAttr('title');
            $('<p class="tooltip1"></p>')
            .text(title)
            .appendTo('body')
            .fadeIn('slow');
    }, function() {
            // Hover out code
            $(this).attr('title', $(this).data('tipText'));
            $('.tooltip1').remove();
    }).mousemove(function(e) {
            var mousex = e.pageX + 20; //Get X coordinates
            //var mousey = e.pageY + 10; //Get Y coordinates
            $('.tooltip1')
            .css({ top: mousey, left: mousex })
    });

    */