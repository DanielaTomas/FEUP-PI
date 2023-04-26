function translateText(targetId, sourceLang, targetLang) {
    const input = document.getElementById(targetId);
    const text = input.value;
    if (!text) {
        return;
    }
    const apiKey = 'YOUR_API_KEY_HERE';
    const apiUrl = `https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&from=${sourceLang}&to=${targetLang}`;
    const data = [
        {
            Text: text
        }
    ];
    fetch(apiUrl, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            'Ocp-Apim-Subscription-Key': apiKey,
            'Ocp-Apim-Subscription-Region': 'YOUR_SUBSCRIPTION_REGION'
        }
    })
    .then(response => response.json())
    .then(data => {
        const translation = data[0].translations[0].text;
        input.value = translation;
    })
    .catch(error => {
        console.error('Error translating text:', error);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const translateBtns = document.querySelectorAll('.translate-btn');
    translateBtns.forEach(btn => {
        const targetId = btn.getAttribute('data-target');
        const sourceLang = btn.getAttribute('data-lang-from');
        const targetLang = btn.getAttribute('data-lang-to');
        btn.addEventListener('click', () => {
            translateText(targetId, sourceLang, targetLang);
        });
    });
});
