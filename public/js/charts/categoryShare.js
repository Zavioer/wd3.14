let barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("category-share", {
    type: "pie",
    data: {
      labels: ["Italy", "France", "Spain", "USA", "Argentina"],
      datasets: [{
        backgroundColor: barColors,
        data: [55, 49, 44, 24, 15]
      }]
    },
    options: {
      title: {
        display: true,
        text: "World Wide Wine Production"
      }
    }
  });