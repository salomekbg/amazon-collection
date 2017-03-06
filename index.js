$(document).ready(function() {
  createDB()
  showItems()

  $('#empty-button').click(function(event){
    event.preventDefault()
    dropTable()
  })

  $('#add-button').hide().click(function(event){
    event.preventDefault()
    addItems([$('h4')[2].innerHTML, $('h4')[4].innerHTML, $('h4')[6].innerHTML, $('h4')[8].innerHTML])
  })

  $('#search-button').click(function(event) {
    event.preventDefault()
    findItems($('#asin')[0].value)
  })
})

function findItems(asin){
  $.ajax({
    method: "POST",
    url: '/finditems.php',
    data: {data: asin}
  }).done(function(result){
    $('.result')[0].innerHTML = `<br /><br /><br/ >`
    $('.result').append(`<table><h4><tr><td><h4>ASIN:</h4></td><td><h4>${result["ASIN"]}</h4></td></tr><tr><td><h4>Title:</h4></td><td><h4>${result["Title"]}</h4></td></tr><tr><td><h4>MPN:</h4></td><td><h4>${result["MPN"]}</h4></td></tr><tr><td><h4>Price:</h4></td><td><h4>${result["Price"]}</h4></td></tr></table>`)
    $('#add-button').show()
  })
}

function addItems(info){
  $.ajax({
    method: "POST",
    url: '/addtodb.php',
    data: {data: {asin: info[0], title: info[1], mpn: info[2], price: info[3]}}
  }).done(function(result){
    $('.result')[0].innerHTML = `<br />`
    $('#asin')[0].value = ''
    $('#add-button').hide()
    showItems()
  })
}

function showItems(){
  $.ajax({
    method: "GET",
    url: 'showdb.php'
  }).done(function(result){
    $('#collection')[0].innerHTML = ""
    if (result.includes("<td>")) {
      $('#collection').append(result)
    } else {
      $('#collection').append("<h5>You have no collection yet! Search by ASIN to find items.</h5>")
    }
  })
}

function createDB(){
  $.ajax({
    method: "GET",
    url: 'createdb.php'
  }).done(function(result){
  })
}

function dropTable(){
  $.ajax({
    method: "GET",
    url: 'droptable.php'
  }).done(function(result){
    createDB()
    showItems()
  })
}
