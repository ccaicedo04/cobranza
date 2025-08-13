function setupCanvas(canvas) {
    const dpr = window.devicePixelRatio || 1;
    const rect = canvas.getBoundingClientRect();
    canvas.width = rect.width * dpr;
    canvas.height = rect.height * dpr;
    const ctx = canvas.getContext('2d');
    ctx.scale(dpr, dpr);
    return ctx;
}

function pieChart(id, data) {
    const canvas = document.getElementById(id);
    const ctx = setupCanvas(canvas);
    const total = data.reduce((s, d) => s + parseFloat(d.saldo), 0) || 1;
    let start = 0;
    data.forEach((d, i) => {
        const slice = (parseFloat(d.saldo) / total) * Math.PI * 2;
        ctx.beginPath();
        ctx.moveTo(125, 125);
        ctx.arc(125, 125, 120, start, start + slice);
        ctx.fillStyle = `hsl(${i * 60},70%,60%)`;
        ctx.fill();
        start += slice;
    });
}

function barChart(id, data) {
    const canvas = document.getElementById(id);
    const ctx = setupCanvas(canvas);
    const width = canvas.clientWidth;
    const height = canvas.clientHeight;
    const max = Math.max(...data.map(d => parseFloat(d.saldo)), 1);
    const barWidth = width / data.length;
    data.forEach((d, i) => {
        const h = (parseFloat(d.saldo) / max) * (height - 20);
        ctx.fillStyle = '#36a2eb';
        ctx.fillRect(i * barWidth + 10, height - h - 10, barWidth - 20, h);
        ctx.fillStyle = '#333';
        ctx.fillText(d.nombre, i * barWidth + 10, height - 5);
    });
}

function lineChart(id, data) {
    const canvas = document.getElementById(id);
    const ctx = setupCanvas(canvas);
    const width = canvas.clientWidth;
    const height = canvas.clientHeight;
    const max = Math.max(...data.map(d => parseFloat(d.total)), 1);
    ctx.strokeStyle = '#ff6384';
    ctx.beginPath();
    data.forEach((d, i) => {
        const x = (i / (data.length - 1)) * (width - 20) + 10;
        const y = height - ((parseFloat(d.total) / max) * (height - 20) + 10);
        if (i === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
        ctx.fillStyle = '#ff6384';
        ctx.fillRect(x - 2, y - 2, 4, 4);
    });
    ctx.stroke();
}

document.addEventListener('DOMContentLoaded', () => {
    const d = window.dashboardData;
    if (!d) return;
    pieChart('chartPie', d.topResponsables);
    barChart('chartBar', d.cartera);
    lineChart('chartLine', d.recaudo);
});
