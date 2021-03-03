    
    
    
    function disAble_bsg(){
    
      $(document).ready(function(){
            
              $("#customPartner").click(function(){
          $("#bronzeid,#silverid,#goldid").children().addClass("card text-white bg-secondary disable-div");
        });
      
      
      }); 
    }
function disAble_csg(){
 
  $(document).ready(function(){
        
          $("#bronzePartner").click(function(){
      $("#customid,#silverid,#goldid").hide();
    });
  
  
  
})
}
function disAble_bcg(){
  
  $(document).ready(function(){
        
          $("#silverPartner").click(function(){
      $("#bronzeid,#customid,#goldid").hide();
    });
  
  
  
})
}
function disAble_bcs(){
 
  $(document).ready(function(){
        
          $("#goldPartner").click(function(){
      $("#bronzeid,#silverid,#customid").hide();
    });
  
  
  
})
}
