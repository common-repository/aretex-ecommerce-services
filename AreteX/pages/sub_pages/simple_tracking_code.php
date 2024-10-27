<div class="section group"> <!-- ROW -->
    <div class="col span_8_of_12"> <!-- Column -->

<div class="ui-widget-header ui-corner-top" >
<h2 style="text-align: center; margin-top: 5px; margin-bottom: 5px;">Setup Simple Tracking Code</h2>
</div>
<div class="ui-widget ui-widget-content  ui-corner-bottom" style="padding: 5px;" >
    
<div id="wizard">
    <!-- steps will go here -->
    <div data-jwizard-title="Basics" id="s1">
       <div style="margin: 5px;">
       An AreteX&trade; tracking code helps you track three things. This wizard helps with the first one.
        <ol>           
             <li>The "<em><strong>Offer</strong></em>": An offer can be "<em>Standard</em>" - i.e. a regular product at a 
            regular price, or a 
                    "<em>Special</em>" - i.e. a discount (only Special used in Simple Tracking Code Wizard).
            </li> 
            <li>The "<em><strong>Referrer</strong></em>":   The person who gets the commission. Individual referrer tracking 
            codes are automatically generated by AreteX, based on the offer codes and media sources you make available.  
            (Click Here for more details.)
               </li>
             <li>The "<em><strong>Media Source</strong></em>": A Media Source is the venue used to provide a sales opportunity. 
             This can be a website, radio or TV spot, brochure, business card, etc. (This wizard defaults to Web.)</li>
        </ol>  
       
       </div> 
    </div>
    
        <div data-jwizard-title="Default Tracking" id="s2">
       <div style="margin: 5px;">
         <label>Choosing the Default</label>
        <p>A default offer code ("Regular Price") and a default media source (Web) have already been setup. 
        The default referal link your referrers will use will look something like this:</p>
        <div style="font-size: 12px; font-family: Courier New, Courier, monospace;">
        <? echo self::default_tracking(); ?>
        </div>
        <p>
        Click this button to use these defaults and skip to the end.  
                  <button type="button" onclick="jumpto_end();" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-secondary" 
          role="button" aria-disabled="false"><span class="ui-button-text">Accept Defaults</span><span class="ui-button-icon-secondary ui-icon ui-icon-seek-end"></span></button>
          </p>
          <p>To create a new offer code for tracking, click "Next."</p> 
       </div> 
    </div>
    
    <div data-jwizard-title="Offer Pricing" id="s3">
       
        <div style="margin: 5px;" >
               

             <div id="std_offer_price">
                <div class="ui-widget">
                    <label for="is_std_price">Offer Pricing</label>
                        <select onchange="chg_offer();" id="is_std_price"><option value="STD">Standard Offer </option><option value="DIS">Special Offer - % Discount</option></select>

                </div>                
             </div>
             <div id="dis_offer" class="special_offer" >
               <form id="discount_price_form">
                    <div class="ui-widget">
                        <label  for="pct_off">Percent Off Total Purchase: </label>
                        <input type="text" class="required number" min="0.01" max="100"   style="width: 75px;" id="pct_off" /> %                        
                    </div>
                </form>
                <p>This discount will be applied to the entire purchase (not including tax and shipping) at the time of payment.</p>
                <hr />
             </div>
             <p>In this wizard, "Standard Offer Pricing" means that no discount will be applied when this offer is used. To 
               make this a discount offer, select "Special Offer - % Discount" in the pull down above.</p>
             <div id="wait_for_save"></div>
         </div>
    </div>
    <div data-jwizard-title="Offer Limits" id="s4">
        <div style="margin: 5px;" >
                <div id="offer_limits">
                <div class="ui-widget">
 
                    <label for="offer_limit_sel">Offer Limits</label>
                        <select onchange="chg_offer_limit();" id="offer_limit_sel"><option value="NONE">No Limits </option><option value="EXP">Offer Expires ...</option></select>

                </div>
                <div id="offer_exp" class="offer_limit" >
                    <form id="offer_limit_form">
                    <div class="ui-widget">
                        <label  for="exp_date">Offer Expiration Date: </label>
                        <input type="text" class="required date"  style="width: 100px;" id="exp_date" />                        
                    </div>
                    </form>               
             </div> 
             <p>With this wizard, you may have "No Limits" or have the offer be limited by an expiration date.
                <br/><em>Note:</em> An offer with "No Limits" is available to all referrers and applies to all products at all times.
                For more limited offers see, "Coupons and Tracking ..." 
                </p>               
             </div>             
        </div>
    
    </div>
    <div data-jwizard-title="Offer Identity" id="s5">
        <!-- step content -->
        <div style="margin: 5px;">

        </div>
        <div style="margin: 5px;" id="offer_id">
            <form id="new_offer_form">
                <label for="offer_name">Change Offer Name</label><input required="required"  id="offer_name" name="offer_name" value="Regular Price" type="text" />
                <br />You may change this if you wish.
               
                <p>This name will appear on the reports and be available on the Payment Tracking and Reporting screen and in WordPress "short codes". </p>
                 
                <label style="display: inline-block;">Change Offer Code</label><input id="offer_code" required="required" name="offer_code" size="25" style="width: 75px;" value="REG" type="text" />
                <br />You may change this if you wish.
                 
                <p>This is a unqiue short identifier used to refer to this offer. It will apppear on reports and in the tracking codes. </p>
            </form>
        </div>
       
    </div>
    

     <div data-jwizard-title="Example" id="s6">
        <!-- step content -->
        <div id="example_panel" style="margin: 5px;" >
        <p>This is an example of what your tracking code might look like.</p>
      
          <div  id="final_example" style="font-size: 12px; font-family: Courier New, Courier, monospace;">
            <? echo self::default_tracking(); ?>
          </div>
          <p>Your referrers will get credit when they send someone to your site using a link similar to the one above. </p>
        </div>
        
    </div>
</div>
<script>

var cancel_pressed;

jQuery(document).ready(function() {
   // put all your jQuery goodness in here.
   jQuery("#wizard")
       .on("stepshow", "#s1", function () {
         cancel_pressed = false;
         return true;
      })       
      .on("stephide", "#s3", function () {         
         return finish_step_3();
      })
      .on("stephide", "#s4", function () {         
         return finish_step_4();
      })
      .on("stephide", "#s5", function () {         
         return finish_step_5();
      })  
       .jWizard(
       {counter: {
    			enable: true,
                type: "count"
                },
            cancel: function () {
                cancel_pressed = true;
                reset_to_defaults();                
                jQuery("#wizard").jWizard("first");
            }
       }   
   );
  
  jQuery('.special_offer').hide();
  jQuery('.offer_limit').hide();
   
 });
 

 function reset_to_defaults() {
    jQuery(function ($) {
        $('.special_offer').hide();
        $('.offer_limit').hide();
        $('input.error').removeClass('error');
        $("label.error").remove(); 
        $('#is_std_price').val('STD');
        $('#offer_name').val('Regular Price');
        $('#offer_code').val('REG');
        $('#offer_limit_sel').val('NONE'); 
        $('#discount_price_form')[0].reset();
        $('#offer_limit_form')[0].reset();
        $('#new_offer_form')[0].reset();
        cancel_pressed = true;
    });
 }
 
 function jumpto_end() {
     reset_to_defaults();
     jQuery("#wizard").jWizard("step",5);
 }
 
 function chg_offer() {
    jQuery(function ($) {
        if ($('#is_std_price').val() == 'STD') {
            $('.special_offer').hide();
        }
        else if ($('#is_std_price').val() == 'DIS') {
            $('#dis_offer').show();
            
        }
    });
 }
 
 function chg_offer_limit() {
     jQuery(function ($) {
        if ($('#offer_limit_sel').val() == 'NONE') {
            $('.offer_limit').hide();
        }
        else if ($('#offer_limit_sel').val() == 'EXP') {
            $('#offer_exp').show();
            
        }
    });
    
 }
 
 function finish_step_3()
 {
     var is_valid = true;
     jQuery(function ($) {
        if ($('#is_std_price').val() == 'DIS' && ! cancel_pressed)
        {
            $('#discount_price_form').validate();
            if (!  $('#discount_price_form').valid() )
            {
                 is_valid = false;
            }
                                             
        }
        else
        {
            $('#discount_price_form')[0].reset();
            
        }
           
            
     });
     
   
     
     return is_valid;
 }
 
 function setup_offer_code() {
    jQuery(function ($) {       
        var change = false;
        var amt = '';
        var code = '';
        if ($('#is_std_price').val() == 'DIS') {
            amt = $('#pct_off').val();
            code = amt.replace('.','X');
            code = 'D'+code;
            change = true;  
        }
                       
        if (change) {
             $('#offer_code').val(code);
        }
           
    }); 
 }
 
 
 function build_new_name() {    
    jQuery(function ($) {
        var name = '';
        var change = false;
        if ($('#is_std_price').val() == 'DIS') {
            name = $('#pct_off').val() + '% Discount ';
            change = true;  
        }
        
        if ($('#offer_limit_sel').val() == 'EXP') {
            name += 'Expires:'+ $('#exp_date').val();
            change = true;
        }
        
        if (change) {
             $('#offer_name').val(name);
        }
           
    });    
 }
 
 function finish_step_4() {
    
    var is_valid = true;
    jQuery(function ($) {
        
        if ($('#offer_limit_sel').val() == 'EXP' && ! cancel_pressed)
        {
            $('#offer_limit_form').validate();
            if (!  $('#offer_limit_form').valid() ) {
                 is_valid = false;
            }
                                               
        }
        else
        {
            $('#offer_limit_form')[0].reset();
            
        }
        
        if (is_valid && ! cancel_pressed)
        {
            build_new_name();
            setup_offer_code();
        }
       
    });
    return is_valid;
 }
 
 
 function finish_step_5() {
    
    var is_valid = true;
    if (cancel_pressed)
        return is_valid;
    jQuery(function ($) {
        
        /*
            Validate:
                Name must not be blank
                Code must not be blank
                Code must be unique
                
                Create the offer
        */
        
        $('#new_offer_form').validate(
            {
        		rules: {
        			offer_code: {
        			    required: true,
                        lettersnumbers: true,
                        maxlength: 7, 
        				remote: {
        				    url: ajaxurl,
        				    data: {
                        		action: 'atx_check_offer_code'                            		
                        	},
                            async:false
        				}
        			}
                }
                    
      		}
        );
        if (!  $('#new_offer_form').valid() ) {            
             is_valid = false;
        }
        
        
        
        
        if (is_valid) {
             $('#wait_for_save').html('<center>...Saving - Please Wait...</center>');
            var offer_code = $('#offer_code').val();
            var offer_name = $('#offer_name').val();
            var offer_type = $('#is_std_price').val();
            var pct_off = $('#pct_off').val();
            var limits = null;
            var offer_limit_sel = $('#offer_limit_sel').val();
            var exp_date = null;
            if (offer_limit_sel != 'NONE') {
                limits = new Array();
                limits[0] = offer_limit_sel;
                exp_date = $('#exp_date').val();
            }
            
            $.ajax({
                      type: 'POST',
                      url: ajaxurl,
                      async: false, // Yes, the A is for Asyncronous... but the X is for XML.
                      dataType: 'json',
                      data: {
                        action: 'atx_create_offer',
                        offer_code: offer_code,
                        description: offer_name,
                        limits: limits,
                        exp_date: exp_date,
                        offer_type: offer_type,
                        pct_off: pct_off
                      },
                      success: function(data){
                         if (data == 'Error')
                         {
                            alert('Offer Code Not Saved');
                            is_valid = false;
                         }
                         else
                         {
                            $('#final_example').html(data);
                         }
                         $('#wait_for_save').html('');
                                                                        
                      }
                      
                    });
                   
          } 
        });
        
    
    return is_valid;
 }
 
 

</script>

    
</div>
</div> <!-- END Column -->
<div class="col span_4_of_12"> <!-- Column -->

<div class="ui-widget ui-widget-content  ui-corner-all container" >
<strong>Simple Tracking Code Wizard</strong>
</div>
</div> <!-- END Column -->
    
</div> <!-- END ROW -->