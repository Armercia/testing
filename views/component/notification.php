



<div id='notification' 
   class="absolute top-0 end-0 text-sm  max-w-xs m-5
      <?php echo $data['type'] == 'error' ? "bg-red-500 text-white " : "bg-gray-100 " ?> 
      <?php echo $data['type'] == 'success' ? "bg-green-500 text-white " : "bg-gray-100 " ?> 
      
      rounded-lg " style = 'z-index:9999; color:white !important'>
  <div class=" max-w-xs rounded-xl  shadow-lg ">
    <div class="p-3">
      <p class="text-xs  text-white   sm:text-base">
   
      <?php echo ($data['message'] ) ?? '' ?>
</p>
    </div>

  </div>
</div>






<script>

setTimeout(function(){
    let toastContainer = document.getElementById('notification');
        toastContainer.style.display = 'none';
}, 3000)

</script>


