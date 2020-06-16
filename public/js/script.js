import '../css/styles.css';

if (module.hot) {
    module.hot.accept()
}

let limit = $('#limit')
limit.append($("<option></option>").attr("value",0).text('Sınırsız'));
for(let i = 1; i <= 100; i++ ) {
    limit.append($("<option></option>").attr("value",i).text(i));
}

