<div class="container" style="margin:20px;padding:10px;border:1px solid #373e98;border-radius:5px;">
    <h5>Kategoriju filtrs</h5>
    <form action="" id="filter">
        
       
    </form>
</div>

<script>
    $(document).ready(function(){
                $.get("<?=base_url()?>/front/getFilterData",function(resp){
                    console.log(resp);
                    for(x in resp){
                        $("#filter").append(`
                        <div class="form-check">
                        <input class="form-check-input" name="cat_filter" type="checkbox" id="" value="${resp[x].id}">
                        <label class="form-check-label">
                            ${resp[x].cat_name}
                        </label>
                    </div>

                        `);
                    }
                })
                .then(function(){
                    $('input[name="cat_filter"]').click(function(e){
                                if($('input[name="cat_filter"]')[0].checked && $('input[name="cat_filter"]')[1].checked){
                                    
                                }
                                else if($('input[name="cat_filter"]')[0].checked){
                                    console.log("first filter checked");
                                }
                                else if($('input[name="cat_filter"]')[1].checked){
                                    console.log("second filter checked");
                                }else{
                                    console.log("none filter checked");
                                }
                            
                        })
                    });
                });    
</script>