fetch(`/monthlyIncome`
).then((response) => {
  return response.json();
}).then(data => {
  const totalPrice = data.totalPrice;

  new Chart("income-chart", {
    type: "line",
    data: {
      labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ],
      datasets: [{
        backgroundColor: "rgba(218, 165, 32, 1.0)",
        borderColor: "rgba(218, 165, 32, 0.1)",
        data: totalPrice
      }]
    },
    options: {
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Months',
          }
        },
        y: {
          title: {
            display: true,
            text: 'Total income [$]',
          }
        }
      }
    }
  });
  
  console.log(data);
});

