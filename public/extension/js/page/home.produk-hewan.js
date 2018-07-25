var produkHewan = []
var produkKategori = []
var filteredDataGlobalHewan = []
var categorized = []
var itemShowPerPage = 8
var pagedItem = []

$.ajax({
    url: '/api/produk/hewan',
    method: 'GET',
    dataType: 'json'
}).done(function(response) {

    $('#filter-harga-min').prop('placeholder', "min. " + response.data.sort(function(a, b) {
        return a.harga - b.harga
    })[0].harga)
    $('#filter-harga-max').prop('placeholder', "maks. " + response.data.sort(function(a, b) {
        return b.harga - a.harga
    })[0].harga)

    categorized = filteredDataGlobalHewan = produkHewan = response.data.sort(function(a, b) {
        let Aname = a.nama.toUpperCase()
        let Bname = b.nama.toUpperCase()

        if (Aname < Bname) {
            return -1
        } else if (Aname > Bname) {
            return 1
        }

        return 0
    })


    render(produkHewan)
})

$.ajax({
    url: '/api/kategori_produk/jenis/1',
    method: 'GET',
    dataType: 'json'
}).done(function(response) {
    produkKategori = response.data

    let options = []
    for (let item of produkKategori) {
        let option = document.createElement('option')
        option.setAttribute('value', item.id)
        option.innerHTML = item.nama

        options.push(option)
    }
    $('#filter-kategori').append($(options).clone())
})

$('select#filter-kategori').on('change', function() {
    let kategoriId = $(this).val()

    categorized = filteredDataGlobalHewan = produkHewan
    if (kategoriId != 0) {
        categorized = filteredDataGlobalHewan = filteredDataGlobalHewan.filter(function(item) {
            return item.idKategori == kategoriId
        })
    }
    $('select#filter-urut').val(0)
    $('#filter-harga-min').val('')
    $('#filter-harga-max').val('')
    $('input#filter-cari').val('')
    render(filteredDataGlobalHewan)
})

$('input#filter-cari').on('keyup', function() {
    let regex = new RegExp($(this).val(), "gi")
    let searchResult = filteredDataGlobalHewan.filter(function(item) {
        return regex.test(item.nama)
    })
    render(searchResult)
})

$('#filter-harga-min').on('keyup', function() {
    let minValue = parseInt($(this).val())
    let maxValue = parseInt($('#filter-harga-max').val())
    if (isNaN(maxValue)) {
        maxValue = produkHewan.sort(function(a, b) {
            return b.harga - a.harga
        })[0].harga
    }
    if (isNaN(minValue)) {
        minValue = 0
    }
    filteredDataGlobalHewan = categorized
    filteredDataGlobalHewan = filteredDataGlobalHewan.filter(function(item) {
        return (item.harga >= minValue && item.harga <= maxValue)
    })

    render(filteredDataGlobalHewan)
})
$('#filter-harga-max').on('keyup', function() {
    let minValue = parseInt($('#filter-harga-min').val())
    let maxValue = parseInt($(this).val())
    if (isNaN(maxValue)) {
        maxValue = produkHewan.sort(function(a, b) {
            return b.harga - a.harga
        })[0].harga
    }
    if (isNaN(minValue)) {
        minValue = 0
    }
    filteredDataGlobalHewan = produkHewan
    filteredDataGlobalHewan = filteredDataGlobalHewan.filter(function(item) {
        return (item.harga >= minValue && item.harga <= maxValue)
    })

    render(filteredDataGlobalHewan)
})

$('select#filter-urut').on('change', function() {
    let urutId = $(this).val()
    if (urutId == 0) {
        filteredDataGlobalHewan.sort(function(a, b) {
            let Aname = a.nama.toUpperCase()
            let Bname = b.nama.toUpperCase()

            if (Aname < Bname) {
                return -1
            } else if (Aname > Bname) {
                return 1
            }

            return 0
        })
    } else if (urutId == 1) {
        filteredDataGlobalHewan.sort(function(a, b) {
            let Aname = a.nama.toUpperCase()
            let Bname = b.nama.toUpperCase()

            if (Aname > Bname) {
                return -1
            } else if (Aname < Bname) {
                return 1
            }

            return 0
        })
    } else if (urutId == 2) {
        filteredDataGlobalHewan.sort(function(a, b) {
            return a.harga - b.harga
        })
    } else if (urutId == 3) {
        filteredDataGlobalHewan.sort(function(a, b) {
            return b.harga - a.harga
        })
    }
    render(filteredDataGlobalHewan)
})

function dataToCard(data) {
    let cardData = []
    for (let item of data) {
        let article = document.createElement('article')
        article.classList.add('col-6', 'col-md-3', 'chupy-product-card')

        let cardBody = document.createElement('a')
        cardBody.setAttribute('href', '/produk/detail-produk/' + item.id)
        cardBody.classList.add("card")

        let cardImageHeader = document.createElement('img')
        cardImageHeader.classList.add('card-img-top')
        cardImageHeader.setAttribute('alt', "Foto Produk " + item.nama)
        let cardThumbnail = ''
        if (item.foto.length != 0) {
            cardThumbnail = '/extension/upload/' + item.foto[0].gambar
        } else {
            cardThumbnail = '/extension/img/chupy-box-ATOL.png'
        }
        cardImageHeader.setAttribute('src', cardThumbnail)

        let cardBodyText = document.createElement('div')
        cardBodyText.classList.add('card-body')

        let cardTitle = document.createElement('h5')
        cardTitle.classList.add('card-title')
        cardTitle.innerHTML = item.nama

        let cardDescription = document.createElement('p')
        cardDescription.classList.add('card-text')
        cardDescription.innerHTML = 'IDR ' + item.harga

        cardBodyText.appendChild(cardTitle)
        cardBodyText.appendChild(cardDescription)

        cardBody.appendChild(cardImageHeader)
        cardBody.appendChild(cardBodyText)

        article.appendChild(cardBody)

        cardData.push(article)
    }

    return cardData
}

function render(data) {
    pagedItem = []
    let countData = data.length
    let countPage = paginationMaker(countData)
    if (countData > itemShowPerPage) {
        let leftItem = countData
        let dataIndex = 0
        for (let i = 0; i < countPage; i++) {
            let page = []

            if (leftItem > itemShowPerPage) {
                for (let j = dataIndex; j < (i + 1) * itemShowPerPage; j++) {
                    page.push(data[j])

                    dataIndex++
                }
                leftItem -= itemShowPerPage
            } else {
                for (let j = dataIndex; j < countData; j++) {
                    page.push(data[j])
                    dataIndex++
                }
            }

            pagedItem.push(page)
        }

        showToPage(dataToCard(pagedItem[0]))
    } else {
        pagedItem = data
        showToPage(dataToCard(pagedItem))
    }
}


function showToPage(JElements) {
    $('.chupy-product-list .row').html("")
    $('.chupy-product-list .row').append($(JElements).clone())
}


// breadcrumb
function paginationMaker(countData) {
    let countPagination = Math.ceil(countData / itemShowPerPage)

    if (countPagination < 2) {
        $('.chupy.chupy-product-pagination')[0].classList.toggle('hide', true)
    } else {
        $('.chupy.chupy-product-pagination')[0].classList.toggle('hide', false)
    }

    let pagination = []
    for (let i = 0; i < countPagination; i++) {
        let li = document.createElement('li')
        li.classList.add('page-item')
        let a = document.createElement('a')
        a.classList.add('page-link')
        a.setAttribute('href', '#chupy-area')
        a.setAttribute('onclick', 'paginationChangePage(' + i + ')')
        a.innerHTML = i + 1

        li.appendChild(a)
        pagination.push(li)
    }

    $('.chupy.chupy-product-pagination .pagination').html('')
    $('.chupy.chupy-product-pagination .pagination').append(pagination)

    return countPagination
}

function paginationChangePage(page) {
    showToPage(dataToCard(pagedItem[page]))
}