# DATABASE

* Implement database CRUD operations and other functionalities.
* Example: Agricultural Products Management System for Farmers' Associations.
* System used: Apache, PHP, MySQL
* For more detailed information, please refer to the 資料庫.pdf file.




### Database related information: 
* Write ahead log: 在修改任何資料時，必須先寫入 log 紀錄，以利之後發生錯誤時能夠回復到原先的狀態。
* Cascading rollback: 因為當 restart 某個 transation 時，有其他 transation  的資料在執行期間更動，導致必須連同一起 restart 。
* Timestamping protocal:  利用時間的戳記來作為執行的順序，確保 transaction 有依序被執行。若發生 conflict 時，系統則傾向讓較老的交易行 restart ，好處是不會有 livelock , deadlock 的問題。缺點則是會發生 cascading rollback 的問題。
* Two phase protocal : 利用 lock 的技術，在 growing phase 階段一次取得需要的鑰匙鎖，等到都執行結束後則會進到 shrinking phase 釋放鎖讓其他交易執行，這樣能夠防止 transaction 發生 conflict 的問題，保證 serializable。缺點: 因為需要一次取的lock, 因此會有 deadlock 與 livelock 的問題
* deadlock: 交易之間都握著 lock ，互不相讓的情形，使得交易無法繼續。
* livelock: 交易之間都擁有各自所需的 lock ，但釋放時同時又佔用對方的鎖。
* Wait-die:  當 old transaction 跟 young transaction 發生 conflict 時，old transaction 必須要等待 young transaction 的鎖，而 young transaction 若跟 old transaction 要鎖時會易死，因此越年輕的 transaction 會容易死。
* Wound-wait:  當 old transaction 跟 young transaction 要鎖時，old transaction ，會直接搶奪 lock ，young transaction 死，因此較為 aggressive。而如果 young transaction 若跟 old transaction 要鎖時會會一直等待直到 old transcation 釋放。
* BCNF:  if whenever a FD X → A holds inR, then X is a superkey of R
* update anomity:  因為沒有經過正規化會有資料重複的問題，在更新時會需同時更新多筆資料，不然會造成資料不一致的問題。而經過正規化，能夠防止資料重複被儲存的問題。
* material view / view: 為了方便操作，因此另外根據需求建立所需的 table 並儲存( phsical ) 以利後續的查找，material view 更新並非同步，而是在一定時間才會進行同步所以會有資料不一致的問題，且缺點占用硬碟的空間。 而 vew 則是直接在 db  進行查詢不會實際存在 disk 中，缺點是查詢時間會比較久，但不占用儲存空間。
* shadow paging recovery protocol:
優點: no redo, undo 
缺點: 會需要較多的儲存空間
* 2NF: Full functional dependency
* 3NF: Transitive dependency 
