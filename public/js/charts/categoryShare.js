fetch(`/ordersCountByProductType`
).then((response) => {
  return response.json();
}).then(data => {
  const year = data.year;
  const month = data.month;
  const productType = data.productTypeName;
  const ordersCount = data.ordersCount;
  
  let barColors = [
    "#808080",
    "#505050",
    "#e0e0e0",
    "#b0b0b0",
    "#303030" 
  ];
    
  new Chart("category-share", {
    type: "pie",
    data: {
      labels: productType,
      datasets: [{
        backgroundColor: barColors,
        data: ordersCount 
      }]
    },
    options: {
      plugins: {
        legend: {
          position: 'right',
        }
      },
      title: {
        display: false,
      },
    }
  });
});

