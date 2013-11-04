Uebung 8 Patrice Keusch
=======================

Aufgabe 4: Erweitern Sie das Data Row Pattern so dass Isolation ohne Transaktionen gegeben sind. Implementieren Sie dazu ein optimitisches Locking Verfahren.
---------


Aufgabe 5: Beschreiben Sie die User Interaktinoen beim optimistischen locking. Als welche Fälle können auftreten und wie soll die Softwware daraug reagieren. Legen Sie die Antworten entweder beschreibend als Textfile ab oder implementieren Sie dieses.
---------

Bei diesem Verfahren werden die Datensätze bei Lesezugriffe nicht gelockt. Dadurch ist es möglich, dass mehrere Benutzer gleichzeitig darauf zugreifen können. Bei einem Lesezugriff wird zudem der Status der Ressource gespeichert. Problematisch wird es erst, wenn ein Benutzer ein Update auf die DB macht. Bevor dieses Update durchgeführt wird,
wird die effektive Ressource mit der gespeicherten Ressource verglichen. Wenn diese noch überein stimmt, wird das Update durchgeführt, ansonsten kommt es zum Rollback der Transaktion. Je nach Implementierung wird dann eine OptimisticLockException geworfen, Benutzer informiert und Statemant je nach dem nochmals ausgeführt.


Aufgabe 6: Beschreiben Sie einen Deadlock
---------

In einer Datenbank, ist ein Deadlock eine Situation welche entsteht, wenn zwei oder mehrere DB-Session Ressourcen auf einer Datenbank locken und jede DB-Session fragt nach dem lock von einer anderen bereites von einer anderen DB-Session gelockten Datenbank. Da nun alle DB-Session auf einander warten, kann nicht weitergearbeitet werden.

Scenario:

Zwei DB-Sessions: A + B

- A hat ein lock auf Daten "Personen" (Select auf eine Person)
- B hat ein lock auf Daten "Rechungen" (Select alle Rechungen)
- A braucht nun den lock auf "Rechungen" für ein SQL-Statement (Zeige alle Rechnungen für diese Person). Dieses ist aber gelockt von B.
- B braucht nun den lock auf "Personen" für ein SQL-Statement (Zeige die Personendaten des Rechnungsstellers). Diese ist aber gelockt von A.
- A + B warten beide, bis sie den lock machen können. Diesen werden sie jedoch nie erhalten. (Ausser es sind Massnahmen für dieses Szenario vorgesehen)

Aufgabe 7: Welche probleme durch mangelnde Transaktionsisolation können durch ein optimistisches locking behoben werden?
--------

Lost-Update Problem:

Mit einem gut implementierten optimitischen Locking Verfahren könnte dem Problem könnte man dieses Problem lösen.

Non-Repeatable-Read:

Mit Hilfe einer versionierung der gelockten Ressourcen und vorheriges abgleichen bei Updates kann dem Problem entgegen gewirkt werden. Oder man lockt alles so lange, bis die Transaktion abgeschlossen ist. (eher doofe Lösung)