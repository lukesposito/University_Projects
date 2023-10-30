param N;  # Dimensione dell'insieme di f
param n;  # Numero massimo di valori distinti per g

set T := 1..N;  # Insieme su cui sono definite le funzioni f e g

param y_i{T}; # Valore che assume la funzione f
param f{i in T} = y_i[i]; # Assegnazione dei valori di y ad f

var g{T} >= 0;  # Definizione della variabile g
var isDistinct{i in T} binary;  # Variabili binaria utilizzata per indicare se g[i] è distintivo

subject to sum_f: sum{i in T} f[i] = 1; # Vincolo di normalizzazione per f
subject to sum_g: sum{i in T} g[i] = 1;  # Vincolo di normalizzazione per g

# Vincolo che permette di capire se il valore della funzione precedente 
# rispetto a quella corrente è più grande o più piccolo
subject to valisDistinct : sum{i in T} (isDistinct[i]) = n-1;

# Vincolo che se la variabile isDistinct[i] = 1  allora g[i] <= 1, 
# se isDistinct = 0 allora g[i] <= g[i-1]
subject to vincoloisDistinctPrec{i in T : i > 1} : g[i] <= g[i-1] + isDistinct[i]; 

# Vincolo che se la variabile isDistinct[i] = 1 allora g[i] >= 1, 
# se isDistinct = 0 allora g[i] >= g[i-1]
subject to vincoloisDistinctSucc{i in T : i > 1} : g[i] >= g[i-1] - isDistinct[i]; 

var error_abs{T} >= 0;  # Variabile per l'errore assoluto

# Vincoli che permettono di rendere la funzione obiettivo lineare
subject to errorConstraint{i in T} : error_abs[i] >= f[i] - g[i];  # Vincolo sull'errore assoluto
subject to errorConstraintNeg{i in T} : error_abs[i] >= g[i] - f[i];  # Vincolo sull'errore assoluto negato

minimize total_error: sum{i in T} (error_abs[i]);  # Minimizzazione dell'errore totale



