const API = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2libUZ0WlNJNkltbHVhWFJwWVd3aUxDSndjbTltYVd4bFgzQnJJam8yTkRjME56WjkuTVp6N2llOEM2S3k5RHVCQTV2NzdTQ2J3REVNcFRmdjBROFFaaDBxWUxqX21FLWFiX2hCQ0NWa1ExZ2U5Y3hwQjJxWUluVWs4b19Vd1BNVzlPY0tUWEE='        // your api here
const integrationID = 3160861;

async function firstStep () {
    let data = {
        "api_key": API
    }

    let request = await fetch('https://accept.paymob.com/api/auth/tokens' , {
        method : 'post',
        headers : {'Content-Type' : 'application/json'} ,
        body : JSON.stringify(data)
    })

    let response = await request.json()

    let token = response.token

    secondStep(token)
}

async function secondStep (token) {
    let data = {
        "auth_token":  token,
        "delivery_needed": "false",
        "amount_cents": "100",
        "currency": "EGP",
        "items": [],
    }

    let request = await fetch('https://accept.paymob.com/api/ecommerce/orders' , {
        method : 'post',
        headers : {'Content-Type' : 'application/json'} ,
        body : JSON.stringify(data)
    })

    let response = await request.json()

    let id = response.id

    thirdStep(token , id)
}

async function thirdStep (token , id) {
    let data = {
        "auth_token": token,
        "amount_cents": "10000",
        "expiration": 3600,
        "order_id": id,
        "billing_data": {
            "apartment": "803",
            "email": "admin@gmail.com",
            "floor": "42",
            "first_name": "Clifford",
            "street": "Ethan Land",
            "building": "8028",
            "phone_number": "+86(8)9135210487",
            "shipping_method": "PKG",
            "postal_code": "01898",
            "city": "Jaskolskiburgh",
            "country": "CR",
            "last_name": "Nicolas",
            "state": "Utah"
        },
        "currency": "EGP",
        "integration_id": integrationID
    }

    let request = await fetch('https://accept.paymob.com/api/acceptance/payment_keys' , {
        method : 'post',
        headers : {'Content-Type' : 'application/json'} ,
        body : JSON.stringify(data)
    })

    let response = await request.json()

    let TheToken = response.token

    cardPayment(TheToken)
}


async function cardPayment (token) {
    let iframURL = `https://accept.paymob.com/api/acceptance/iframes/708449?payment_token=${token}`

    location.href = iframURL
}

// firstStep()
