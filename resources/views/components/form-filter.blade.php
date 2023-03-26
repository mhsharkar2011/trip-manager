<div>
  
</div>

<script>
  const list = document.getElementById('status');
  list.addEventListener('click', function(event) {
    const item = event.target;
    const itemId = item.getAttribute('data-id');
    // Call a function to fetch data and display it based on the item ID
  });

  function fetchData(itemId) {
  $.ajax({
    url: '/data/' + itemId,
    method: 'GET',
    success: function(data) {
      // Display the data on the page
      $('#result').html('<h2>' + data.title + '</h2><p>' + data.content + '</p>');
    },
    error: function(error) {
      console.error('Error fetching data:', error);
    }
  });
}
</script>
