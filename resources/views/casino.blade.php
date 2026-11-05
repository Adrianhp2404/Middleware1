@extends('layouts.app')
@section('title', 'Casino VIP')
@section('content')
<div class="space-y-8">
    <div class="bg-slate-800 border border-emerald-500/50 p-6 rounded-xl shadow-lg text-center space-y-2">
        <span class="text-4xl">🎰</span>
        <h2 class="text-3xl font-bold text-white">Sala de Casino VIP del Grand Royal</h2>
        <p class="text-emerald-400 font-medium">¡Bienvenido, {{ auth()->user()->name }}! Pon a prueba tu suerte en nuestras mesas profesionales.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- BLACKJACK -->
        <div class="bg-slate-800 border border-slate-700 p-6 rounded-xl shadow-lg space-y-4">
            <h3 class="text-xl font-bold text-amber-400 text-center">🃏 Blackjack 21</h3>
            <div class="text-xs text-slate-400 text-center">Acércate a 21 sin pasarte (Apuesta: 50 fichas).</div>

            <div class="bg-slate-900 p-4 rounded-lg border border-slate-700 space-y-3">
                <div>
                    <p class="text-xs text-slate-400 mb-1">Crupier:</p>
                    <div id="dealer-cards" class="text-2xl font-bold text-slate-200">-</div>
                </div>
                <hr class="border-slate-700">
                <div>
                    <p class="text-xs text-slate-400 mb-1">Tus Cartas:</p>
                    <div id="player-cards" class="text-2xl font-bold text-amber-300">-</div>
                </div>
            </div>

            <div id="bj-controls" class="flex gap-2">
                <button onclick="startBlackjack()" class="w-full bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2 rounded-lg transition">Repartir (50 🪙)</button>
            </div>
            <div id="bj-actions" class="flex gap-2 hidden">
                <button onclick="hitBlackjack()" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 rounded-lg transition">Pedir Carta</button>
                <button onclick="standBlackjack()" class="flex-1 bg-rose-600 hover:bg-rose-500 text-white font-bold py-2 rounded-lg transition">Plantarse</button>
            </div>
            <p id="bj-result" class="text-center text-sm font-semibold text-slate-300">Presiona repartir para comenzar.</p>
        </div>

        <!-- RULETA EUROPEA -->
        <div class="bg-slate-800 border border-slate-700 p-6 rounded-xl shadow-lg space-y-4">
            <h3 class="text-xl font-bold text-amber-400 text-center">🎡 Ruleta Europea</h3>
            <div class="text-xs text-slate-400 text-center">Elige tu modalidad y apuesta 50 fichas.</div>

            <div class="bg-slate-900 p-6 rounded-lg border border-slate-700 text-center">
                <div id="roulette-wheel" class="text-4xl font-bold text-white mb-2">🎲 0 - 36</div>
                <p id="roulette-msg" class="text-sm text-slate-300">Haz tu apuesta abajo</p>
            </div>

            <div class="grid grid-cols-3 gap-2">
                <button onclick="playRoulette('rojo', 50)" class="bg-rose-600 hover:bg-rose-500 text-white font-bold py-2 rounded-lg transition text-sm">Rojo (x2)</button>
                <button onclick="playRoulette('negro', 50)" class="bg-slate-700 hover:bg-slate-600 text-white font-bold py-2 rounded-lg transition text-sm">Negro (x2)</button>
                <button onclick="playRoulette('par', 50)" class="bg-amber-600 hover:bg-amber-500 text-white font-bold py-2 rounded-lg transition text-sm">Par (x2)</button>
            </div>
        </div>

    </div>

    <div class="text-center pt-4">
        <a href="{{ route('panel') }}" class="bg-slate-700 hover:bg-slate-600 px-6 py-2.5 rounded-lg text-sm transition">Volver a mi habitación</a>
    </div>
</div>

<script>
    function modifyBalance(amount, callback) {
        fetch("{{ route('casino.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ amount: amount })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                document.getElementById('user-balance').innerText = data.balance;
                if(callback) callback(data);
            } else {
                alert(data.message);
            }
        });
    }

    let playerHand = [];
    let dealerHand = [];

    function getRandomCard() {
        return Math.floor(Math.random() * 10) + 1;
    }

    function startBlackjack() {
        modifyBalance(-50, (data) => {
            playerHand = [getRandomCard(), getRandomCard()];
            dealerHand = [getRandomCard()];
            
            updateBjDisplay(false);
            document.getElementById('bj-controls').classList.add('hidden');
            document.getElementById('bj-actions').classList.remove('hidden');
            document.getElementById('bj-result').innerText = "Tu turno: ¿Pedir carta o plantarte?";
            document.getElementById('bj-result').className = "text-center text-sm font-semibold text-amber-300";
        });
    }

    function updateBjDisplay(showAll) {
        document.getElementById('player-cards').innerText = playerHand.join(' + ') + ' (Suma: ' + handSum(playerHand) + ')';
        document.getElementById('dealer-cards').innerText = showAll ? dealerHand.join(' + ') + ' (Suma: ' + handSum(dealerHand) + ')' : dealerHand[0] + ' + ❓';
    }

    function handSum(hand) {
        return hand.reduce((a, b) => a + b, 0);
    }

    function hitBlackjack() {
        playerHand.push(getRandomCard());
        updateBjDisplay(false);
        if (handSum(playerHand) > 21) {
            endBlackjack("💥 ¡Te has pasado de 21! Has perdido 50 fichas.", false);
        }
    }

    function standBlackjack() {
        while (handSum(dealerHand) < 17) {
            dealerHand.push(getRandomCard());
        }
        updateBjDisplay(true);
        
        let pSum = handSum(playerHand);
        let dSum = handSum(dealerHand);

        if (dSum > 21 || pSum > dSum) {
            modifyBalance(100, () => {});
            endBlackjack("🎉 ¡Has vencido al crupier! Ganaste 100 fichas.", true);
        } else if (pSum === dSum) {
            modifyBalance(50, () => {});
            endBlackjack("🤝 ¡Empate! Se te devuelven tus fichas.", true);
        } else {
            endBlackjack("❌ El crupier gana. Pierdes tu apuesta.", false);
        }
    }

    function endBlackjack(msg, win) {
        document.getElementById('bj-actions').classList.add('hidden');
        document.getElementById('bj-controls').classList.remove('hidden');
        let resEl = document.getElementById('bj-result');
        resEl.innerText = msg;
        resEl.className = "text-center text-sm font-semibold " + (win ? "text-emerald-400" : "text-rose-400");
    }

    function playRoulette(type, bet) {
        modifyBalance(-bet, (data) => {
            let number = Math.floor(Math.random() * 37);
            let isRed = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36].includes(number);
            let colorText = number === 0 ? "🟢 0 (Verde)" : (isRed ? "🔴 " + number + " (Rojo)" : "⚫ " + number + " (Negro)");
            
            let win = false;
            if (type === 'rojo' && isRed) win = true;
            if (type === 'negro' && !isRed && number !== 0) win = true;
            if (type === 'par' && number !== 0 && number % 2 === 0) win = true;

            document.getElementById('roulette-wheel').innerText = colorText;
            let msgEl = document.getElementById('roulette-msg');

            if (win) {
                let premio = bet * 2;
                modifyBalance(premio, () => {});
                msgEl.innerText = `🎉 ¡Ganaste ${premio} fichas!`;
                msgEl.className = "text-sm text-emerald-400 font-bold";
            } else {
                msgEl.innerText = `😢 Perdiste la apuesta. Salió ${colorText}`;
                msgEl.className = "text-sm text-rose-400 font-bold";
            }
        });
    }
</script>
@endsection