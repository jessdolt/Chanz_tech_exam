import "./bootstrap";

const API_KEY = "qIBxewUxeFzLOod4r03vUQbZraW6tCyS";
const FROM = "PHP";
const TO = "USD";

window.addEventListener("load", async () => {
    const resultValue = document?.getElementById("hiddenValue")?.textContent;
    const numericValueEl = document?.getElementById("numericValue");

    if (resultValue?.trim().length > 0) {
        const { result } = await fetchConversion(resultValue, FROM, TO);
        if (result) {
            numericValueEl.textContent = `${TO} ${result.toFixed(2)}`;
        }
    }
});

const fetchConversion = async (amount, from = "PHP", to = "USD") => {
    const myHeaders = new Headers();
    myHeaders.append("apikey", API_KEY);

    const options = {
        method: "GET",
        redirect: "follow",
        headers: myHeaders,
    };

    try {
        const response = await fetch(
            `https://api.apilayer.com/currency_data/convert?to=${to}&from=${from}&amount=${amount}`,
            options
        );
        const data = await response.json();
        return data;
    } catch (e) {
        console.error(e);
    }
};

// const parseFilterUrl = (url) => {
//     const parts = url.split("|");
//     const filters = [];
//     for (let i = 0; i < parts.length; i++) {
//         const part = parts[i];
//         const split = part.split(":");
//         const obj = {};
//         obj[split[0]] = split[1].split(",");
//         filters.push(obj);
//     }
//     return filters;
// };
// const filters = parseFilterUrl(
//     "regions:the-north|people:hodor,the-hound|omg:true"
// );

// console.log(filters);

// const newFilterUrl = (url) => {
//     return url.split("|").map((x) => {
//         const [key_name, value] = x.split(":");
//         return { [key_name]: value.split(",") };
//     });
// };

// const newFilters = newFilterUrl(
//     "regions:the-north|people:hodor,the-hound|omg:true"
// );
// console.log({ newFilters });
