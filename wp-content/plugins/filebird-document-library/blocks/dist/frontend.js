!function(){var e={184:function(e,t){var r;!function(){"use strict";var n={}.hasOwnProperty;function a(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var l=typeof r;if("string"===l||"number"===l)e.push(r);else if(Array.isArray(r)){if(r.length){var i=a.apply(null,r);i&&e.push(i)}}else if("object"===l){if(r.toString!==Object.prototype.toString&&!r.toString.toString().includes("[native code]")){e.push(r.toString());continue}for(var o in r)n.call(r,o)&&r[o]&&e.push(o)}}}return e.join(" ")}e.exports?(a.default=a,e.exports=a):void 0===(r=function(){return a}.apply(t,[]))||(e.exports=r)}()},296:function(e,t,r){var n=/^\s+|\s+$/g,a=/^[-+]0x[0-9a-f]+$/i,l=/^0b[01]+$/i,i=/^0o[0-7]+$/i,o=parseInt,s="object"==typeof r.g&&r.g&&r.g.Object===Object&&r.g,c="object"==typeof self&&self&&self.Object===Object&&self,u=s||c||Function("return this")(),d=Object.prototype.toString,f=Math.max,m=Math.min,p=function(){return u.Date.now()};function b(e){var t=typeof e;return!!e&&("object"==t||"function"==t)}function _(e){if("number"==typeof e)return e;if(function(e){return"symbol"==typeof e||function(e){return!!e&&"object"==typeof e}(e)&&"[object Symbol]"==d.call(e)}(e))return NaN;if(b(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=b(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=e.replace(n,"");var r=l.test(e);return r||i.test(e)?o(e.slice(2),r?2:8):a.test(e)?NaN:+e}e.exports=function(e,t,r){var n,a,l,i,o,s,c=0,u=!1,d=!1,y=!0;if("function"!=typeof e)throw new TypeError("Expected a function");function h(t){var r=n,l=a;return n=a=void 0,c=t,i=e.apply(l,r)}function v(e){var r=e-s;return void 0===s||r>=t||r<0||d&&e-c>=l}function g(){var e=p();if(v(e))return E(e);o=setTimeout(g,function(e){var r=t-(e-s);return d?m(r,l-(e-c)):r}(e))}function E(e){return o=void 0,y&&n?h(e):(n=a=void 0,i)}function w(){var e=p(),r=v(e);if(n=arguments,a=this,s=e,r){if(void 0===o)return function(e){return c=e,o=setTimeout(g,t),u?h(e):i}(s);if(d)return o=setTimeout(g,t),h(s)}return void 0===o&&(o=setTimeout(g,t)),i}return t=_(t)||0,b(r)&&(u=!!r.leading,l=(d="maxWait"in r)?f(_(r.maxWait)||0,t):l,y="trailing"in r?!!r.trailing:y),w.cancel=function(){void 0!==o&&clearTimeout(o),c=0,n=s=a=o=void 0},w.flush=function(){return void 0===o?i:E(p())},w}}},t={};function r(n){var a=t[n];if(void 0!==a)return a.exports;var l=t[n]={exports:{}};return e[n](l,l.exports,r),l.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){"use strict";var e=window.React,t=r.n(e),n=window.ReactDOM,a=r.n(n),l=r(184),i=r.n(l),o=Symbol.for("immer-nothing"),s=Symbol.for("immer-draftable"),c=Symbol.for("immer-state");function u(e,...t){throw new Error(`[Immer] minified error nr: ${e}. Full error at: https://bit.ly/3cXEKWf`)}var d=Object.getPrototypeOf;function f(e){return!!e&&!!e[c]}function m(e){return!!e&&(b(e)||Array.isArray(e)||!!e[s]||!!e.constructor?.[s]||g(e)||E(e))}var p=Object.prototype.constructor.toString();function b(e){if(!e||"object"!=typeof e)return!1;const t=d(e);if(null===t)return!0;const r=Object.hasOwnProperty.call(t,"constructor")&&t.constructor;return r===Object||"function"==typeof r&&Function.toString.call(r)===p}function _(e,t){0===y(e)?Object.entries(e).forEach((([r,n])=>{t(r,n,e)})):e.forEach(((r,n)=>t(n,r,e)))}function y(e){const t=e[c];return t?t.type_:Array.isArray(e)?1:g(e)?2:E(e)?3:0}function h(e,t){return 2===y(e)?e.has(t):Object.prototype.hasOwnProperty.call(e,t)}function v(e,t,r){const n=y(e);2===n?e.set(t,r):3===n?e.add(r):e[t]=r}function g(e){return e instanceof Map}function E(e){return e instanceof Set}function w(e){return e.copy_||e.base_}function N(e,t){if(g(e))return new Map(e);if(E(e))return new Set(e);if(Array.isArray(e))return Array.prototype.slice.call(e);if(!t&&b(e)){if(!d(e)){const t=Object.create(null);return Object.assign(t,e)}return{...e}}const r=Object.getOwnPropertyDescriptors(e);delete r[c];let n=Reflect.ownKeys(r);for(let t=0;t<n.length;t++){const a=n[t],l=r[a];!1===l.writable&&(l.writable=!0,l.configurable=!0),(l.get||l.set)&&(r[a]={configurable:!0,writable:!0,enumerable:l.enumerable,value:e[a]})}return Object.create(d(e),r)}function C(e,t=!1){return P(e)||f(e)||!m(e)||(y(e)>1&&(e.set=e.add=e.clear=e.delete=S),Object.freeze(e),t&&_(e,((e,t)=>C(t,!0)))),e}function S(){u(2)}function P(e){return Object.isFrozen(e)}var x,O={};function j(e){const t=O[e];return t||u(0),t}function z(){return x}function M(e,t){t&&(j("Patches"),e.patches_=[],e.inversePatches_=[],e.patchListener_=t)}function q(e){R(e),e.drafts_.forEach(k),e.drafts_=null}function R(e){e===x&&(x=e.parent_)}function F(e){return x={drafts_:[],parent_:x,immer_:e,canAutoFreeze_:!0,unfinalizedDrafts_:0}}function k(e){const t=e[c];0===t.type_||1===t.type_?t.revoke_():t.revoked_=!0}function H(e,t){t.unfinalizedDrafts_=t.drafts_.length;const r=t.drafts_[0];return void 0!==e&&e!==r?(r[c].modified_&&(q(t),u(4)),m(e)&&(e=A(t,e),t.parent_||V(t,e)),t.patches_&&j("Patches").generateReplacementPatches_(r[c].base_,e,t.patches_,t.inversePatches_)):e=A(t,r,[]),q(t),t.patches_&&t.patchListener_(t.patches_,t.inversePatches_),e!==o?e:void 0}function A(e,t,r){if(P(t))return t;const n=t[c];if(!n)return _(t,((a,l)=>D(e,n,t,a,l,r))),t;if(n.scope_!==e)return t;if(!n.modified_)return V(e,n.base_,!0),n.base_;if(!n.finalized_){n.finalized_=!0,n.scope_.unfinalizedDrafts_--;const t=n.copy_;let a=t,l=!1;3===n.type_&&(a=new Set(t),t.clear(),l=!0),_(a,((a,i)=>D(e,n,t,a,i,r,l))),V(e,t,!1),r&&e.patches_&&j("Patches").generatePatches_(n,r,e.patches_,e.inversePatches_)}return n.copy_}function D(e,t,r,n,a,l,i){if(f(a)){const i=A(e,a,l&&t&&3!==t.type_&&!h(t.assigned_,n)?l.concat(n):void 0);if(v(r,n,i),!f(i))return;e.canAutoFreeze_=!1}else i&&r.add(a);if(m(a)&&!P(a)){if(!e.immer_.autoFreeze_&&e.unfinalizedDrafts_<1)return;A(e,a),t&&t.scope_.parent_||V(e,a)}}function V(e,t,r=!1){!e.parent_&&e.immer_.autoFreeze_&&e.canAutoFreeze_&&C(t,r)}var L={get(e,t){if(t===c)return e;const r=w(e);if(!h(r,t))return function(e,t,r){const n=B(t,r);return n?"value"in n?n.value:n.get?.call(e.draft_):void 0}(e,r,t);const n=r[t];return e.finalized_||!m(n)?n:n===$(e.base_,t)?(W(e),e.copy_[t]=K(n,e)):n},has(e,t){return t in w(e)},ownKeys(e){return Reflect.ownKeys(w(e))},set(e,t,r){const n=B(w(e),t);if(n?.set)return n.set.call(e.draft_,r),!0;if(!e.modified_){const n=$(w(e),t),i=n?.[c];if(i&&i.base_===r)return e.copy_[t]=r,e.assigned_[t]=!1,!0;if(((a=r)===(l=n)?0!==a||1/a==1/l:a!=a&&l!=l)&&(void 0!==r||h(e.base_,t)))return!0;W(e),Z(e)}var a,l;return e.copy_[t]===r&&(void 0!==r||t in e.copy_)||Number.isNaN(r)&&Number.isNaN(e.copy_[t])||(e.copy_[t]=r,e.assigned_[t]=!0),!0},deleteProperty(e,t){return void 0!==$(e.base_,t)||t in e.base_?(e.assigned_[t]=!1,W(e),Z(e)):delete e.assigned_[t],e.copy_&&delete e.copy_[t],!0},getOwnPropertyDescriptor(e,t){const r=w(e),n=Reflect.getOwnPropertyDescriptor(r,t);return n?{writable:!0,configurable:1!==e.type_||"length"!==t,enumerable:n.enumerable,value:r[t]}:n},defineProperty(){u(11)},getPrototypeOf(e){return d(e.base_)},setPrototypeOf(){u(12)}},T={};function $(e,t){const r=e[c];return(r?w(r):e)[t]}function B(e,t){if(!(t in e))return;let r=d(e);for(;r;){const e=Object.getOwnPropertyDescriptor(r,t);if(e)return e;r=d(r)}}function Z(e){e.modified_||(e.modified_=!0,e.parent_&&Z(e.parent_))}function W(e){e.copy_||(e.copy_=N(e.base_,e.scope_.immer_.useStrictShallowCopy_))}function K(e,t){const r=g(e)?j("MapSet").proxyMap_(e,t):E(e)?j("MapSet").proxySet_(e,t):function(e,t){const r=Array.isArray(e),n={type_:r?1:0,scope_:t?t.scope_:z(),modified_:!1,finalized_:!1,assigned_:{},parent_:t,base_:e,draft_:null,copy_:null,revoke_:null,isManual_:!1};let a=n,l=L;r&&(a=[n],l=T);const{revoke:i,proxy:o}=Proxy.revocable(a,l);return n.draft_=o,n.revoke_=i,o}(e,t);return(t?t.scope_:z()).drafts_.push(r),r}function U(e){if(!m(e)||P(e))return e;const t=e[c];let r;if(t){if(!t.modified_)return t.base_;t.finalized_=!0,r=N(e,t.scope_.immer_.useStrictShallowCopy_)}else r=N(e,!0);return _(r,((e,t)=>{v(r,e,U(t))})),t&&(t.finalized_=!1),r}_(L,((e,t)=>{T[e]=function(){return arguments[0]=arguments[0][0],t.apply(this,arguments)}})),T.deleteProperty=function(e,t){return T.set.call(this,e,t,void 0)},T.set=function(e,t,r){return L.set.call(this,e[0],t,r,e[0])};var I=new class{constructor(e){this.autoFreeze_=!0,this.useStrictShallowCopy_=!1,this.produce=(e,t,r)=>{if("function"==typeof e&&"function"!=typeof t){const r=t;t=e;const n=this;return function(e=r,...a){return n.produce(e,(e=>t.call(this,e,...a)))}}let n;if("function"!=typeof t&&u(6),void 0!==r&&"function"!=typeof r&&u(7),m(e)){const a=F(this),l=K(e,void 0);let i=!0;try{n=t(l),i=!1}finally{i?q(a):R(a)}return M(a,r),H(n,a)}if(!e||"object"!=typeof e){if(n=t(e),void 0===n&&(n=e),n===o&&(n=void 0),this.autoFreeze_&&C(n,!0),r){const t=[],a=[];j("Patches").generateReplacementPatches_(e,n,t,a),r(t,a)}return n}u(1)},this.produceWithPatches=(e,t)=>{if("function"==typeof e)return(t,...r)=>this.produceWithPatches(t,(t=>e(t,...r)));let r,n;return[this.produce(e,t,((e,t)=>{r=e,n=t})),r,n]},"boolean"==typeof e?.autoFreeze&&this.setAutoFreeze(e.autoFreeze),"boolean"==typeof e?.useStrictShallowCopy&&this.setUseStrictShallowCopy(e.useStrictShallowCopy)}createDraft(e){var t;m(e)||u(8),f(e)&&(f(t=e)||u(10),e=U(t));const r=F(this),n=K(e,void 0);return n[c].isManual_=!0,R(r),n}finishDraft(e,t){const r=e&&e[c];r&&r.isManual_||u(9);const{scope_:n}=r;return M(n,t),H(void 0,n)}setAutoFreeze(e){this.autoFreeze_=e}setUseStrictShallowCopy(e){this.useStrictShallowCopy_=e}applyPatches(e,t){let r;for(r=t.length-1;r>=0;r--){const n=t[r];if(0===n.path.length&&"replace"===n.op){e=n.value;break}}r>-1&&(t=t.slice(r+1));const n=j("Patches").applyPatches_;return f(e)?n(e,t):this.produce(e,(e=>n(e,t)))}},J=I.produce;I.produceWithPatches.bind(I),I.setAutoFreeze.bind(I),I.setUseStrictShallowCopy.bind(I),I.applyPatches.bind(I),I.createDraft.bind(I),I.finishDraft.bind(I);var X=window.wp.i18n,G=({attributes:t,foundPosts:r,request:n,setRequest:a,layout:l,setLayout:o})=>{const s=e=>{o(e)};return(0,e.createElement)("div",{className:"fbdl-layout-control"},(0,e.createElement)("div",{className:"fbdl-layout-control-wrapper"},(0,e.createElement)("div",{className:"fbdl-layout-control-limit"},(0,X.__)("Show","filebird-dl")," ",(0,e.createElement)("input",{type:"number",min:"1",max:200,value:n.pagination.limit,onChange:e=>{const t=e.target.value,r=t.toString().match(/[.,\s]/g);t<=0||r?.length?e.target.value=n.pagination.limit:a(J(n,(e=>{e.pagination.limit=t,e.pagination.current=1})))},disabled:t.isPreview})," ",(0,X.__)("files","filebird-dl")),(0,e.createElement)("div",{className:"fbdl-layout-control-display"},(0,e.createElement)("span",{onClick:()=>s("grid")},(0,e.createElement)("svg",{className:i()({"fbdl-layout-control-display-selected":"grid"===l}),width:"20",height:"20",viewBox:"0 0 20 20",fill:"none",xmlns:"http://www.w3.org/2000/svg"},(0,e.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M6.25 1.875H2.5C2.15482 1.875 1.875 2.15482 1.875 2.5V6.25C1.875 6.59518 2.15482 6.875 2.5 6.875H6.25C6.59518 6.875 6.875 6.59518 6.875 6.25V2.5C6.875 2.15482 6.59518 1.875 6.25 1.875ZM2.5 0C1.11929 0 0 1.11929 0 2.5V6.25C0 7.63071 1.11929 8.75 2.5 8.75H6.25C7.63071 8.75 8.75 7.63071 8.75 6.25V2.5C8.75 1.11929 7.63071 0 6.25 0H2.5Z",fill:"currentColor"}),(0,e.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M17.5 1.875H13.75C13.4048 1.875 13.125 2.15482 13.125 2.5V6.25C13.125 6.59518 13.4048 6.875 13.75 6.875H17.5C17.8452 6.875 18.125 6.59518 18.125 6.25V2.5C18.125 2.15482 17.8452 1.875 17.5 1.875ZM13.75 0C12.3693 0 11.25 1.11929 11.25 2.5V6.25C11.25 7.63071 12.3693 8.75 13.75 8.75H17.5C18.8807 8.75 20 7.63071 20 6.25V2.5C20 1.11929 18.8807 0 17.5 0H13.75Z",fill:"currentColor"}),(0,e.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M17.5 13.125H13.75C13.4048 13.125 13.125 13.4048 13.125 13.75V17.5C13.125 17.8452 13.4048 18.125 13.75 18.125H17.5C17.8452 18.125 18.125 17.8452 18.125 17.5V13.75C18.125 13.4048 17.8452 13.125 17.5 13.125ZM13.75 11.25C12.3693 11.25 11.25 12.3693 11.25 13.75V17.5C11.25 18.8807 12.3693 20 13.75 20H17.5C18.8807 20 20 18.8807 20 17.5V13.75C20 12.3693 18.8807 11.25 17.5 11.25H13.75Z",fill:"currentColor"}),(0,e.createElement)("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M6.25 13.125H2.5C2.15482 13.125 1.875 13.4048 1.875 13.75V17.5C1.875 17.8452 2.15482 18.125 2.5 18.125H6.25C6.59518 18.125 6.875 17.8452 6.875 17.5V13.75C6.875 13.4048 6.59518 13.125 6.25 13.125ZM2.5 11.25C1.11929 11.25 0 12.3693 0 13.75V17.5C0 18.8807 1.11929 20 2.5 20H6.25C7.63071 20 8.75 18.8807 8.75 17.5V13.75C8.75 12.3693 7.63071 11.25 6.25 11.25H2.5Z",fill:"currentColor"}))),(0,e.createElement)("span",{onClick:()=>s("list")},(0,e.createElement)("svg",{className:i()({"fbdl-layout-control-display-selected":"list"===l}),width:"23",height:"16",viewBox:"0 0 23 16",xmlns:"http://www.w3.org/2000/svg"},(0,e.createElement)("path",{d:"M10.2222 2.90918H22.9999M10.2222 13.091H22.9999",stroke:"currentColor",strokeWidth:"1.5"}),(0,e.createElement)("ellipse",{cx:"2.875",cy:"13.0909",rx:"2.875",ry:"2.90909",fill:"currentColor"}),(0,e.createElement)("ellipse",{cx:"2.875",cy:"2.90909",rx:"2.875",ry:"2.90909",fill:"currentColor"}))))))};const Q=(e,t)=>{let r=t-e+1;return Array.from({length:r},((t,r)=>r+e))},Y="...";var ee=({foundPosts:t,maxNumPages:r,request:n,setRequest:a})=>{const{pagination:l}=n,o=(({totalCount:t,pageSize:r,maxNumPages:n,siblingCount:a=1,currentPage:l})=>(0,e.useMemo)((()=>{const e=n;if(a+5>=e)return Q(1,e);const t=Math.max(l-a,1),r=Math.min(l+a,e),i=t>2,o=r<e-2,s=e;if(!i&&o)return[...Q(1,5+a),Y,e];if(i&&!o){let t=Q(e-(5+a)+1,e);return[1,Y,...t]}if(i&&o){let e=Q(t,r);return[1,Y,...e,Y,s]}}),[n,t,r,a,l]))({maxNumPages:r,totalCount:t,currentPage:l.current,pageSize:l.limit});if(0===l.current||o.length<2)return null;const s=e=>l.current==e?"fbdl-selected":"fbdl-unselected";let c=o[o.length-1];const u=l.current*l.limit,d=u-l.limit+1;return(0,e.createElement)("div",{className:"fbdl-pagination"},(0,e.createElement)("div",{className:"fbdl-pagination-wrapper"},(0,e.createElement)("div",{className:"fbdl-pagination-info"},(0,e.createElement)("p",null,(0,X.__)("Showing","filebird-dl")," ",(0,e.createElement)("span",null,d)," ",(0,X.__)("to","filebird-dl")," ",(0,e.createElement)("span",null,u>t?t:u)," ",(0,X.__)("of","filebird-dl")," ",(0,e.createElement)("span",null,t)," ",(0,X.__)("files","filebird-dl"))),(0,e.createElement)("div",{className:"fbdl-pagination-page-number"},(0,e.createElement)("a",{href:!0,className:i()("fbdl-page-previous",{"fbdl-hidden":1==l.current}),disabled:1==l.current,onClick:()=>{a(J(n,(e=>{e.pagination.current=e.pagination.current-1})))}},(0,e.createElement)("span",null,(0,X.__)("Previous","filebird-dl")),(0,e.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},(0,e.createElement)("path",{fillRule:"evenodd",d:"M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z",clipRule:"evenodd"}))),o.map((t=>t===Y?(0,e.createElement)("a",{className:"fbdl-page-dots"},"…"):(0,e.createElement)("a",{href:!0,"aria-current":"page",className:`fbdl-page-number ${s(t)}`,onClick:()=>(e=>{a(J(n,(t=>{t.pagination.current=e})))})(t)},t))),(0,e.createElement)("a",{className:i()("fbdl-page-next",{"fbdl-hidden":l.current==c}),disabled:l.current==c,onClick:()=>{a(J(n,(e=>{e.pagination.current=e.pagination.current+1})))}},(0,e.createElement)("span",null,(0,X.__)("Next","filebird-dl")),(0,e.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor","aria-hidden":"true"},(0,e.createElement)("path",{fillRule:"evenodd",d:"M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z",clipRule:"evenodd"}))))))},te=r(296),re=r.n(te),ne=({request:t,setRequest:r,attributes:n})=>{(0,e.useCallback)(re()((e=>a(e)),500),[t]);const a=async e=>{r(J(t,(t=>{t.search=e,t.pagination.current=1})))};return(0,e.createElement)("div",{className:"fbdl-search-control"},(0,e.createElement)("div",{className:"fbdl-search-control-wrapper"},(0,e.createElement)("div",{className:"fbdl-title"},(0,e.createElement)("svg",{width:"40",height:"32",viewBox:"0 0 48 40",fill:"none",xmlns:"http://www.w3.org/2000/svg"},(0,e.createElement)("path",{d:"M43.178 5.44153H19.1795C18.5049 5.44153 17.8302 5.15513 17.3483 4.6778L14.1678 1.43198C13.3004 0.477327 12.1438 0 10.8909 0H4.81897C2.12035 0 0 2.10024 0 4.77327V35.2267C0 37.8998 2.12035 40 4.81897 40H43.178C45.8766 40 47.997 37.8998 47.997 35.2267V10.2148C48.0933 7.54177 45.8766 5.44153 43.178 5.44153Z",fill:"#007CBA"})),(0,e.createElement)("h2",null,n.title))))};const{assets_icon_url:ae,type_icons:le}=fbdl;var ie=({files:t,column:r})=>(0,e.createElement)("div",{className:"fbdl-gridview"},(0,e.createElement)("div",{className:"fbdl-gridview-wrapper"},(0,e.createElement)("div",{className:"fbdl-gridview-container"},(0,e.createElement)("div",{className:`fbdl-grid fb-col-${r}`},t.map(((t,r)=>(0,e.createElement)("div",{className:"fbdl-grid-item",key:r},(0,e.createElement)("div",{className:"fbdl-grid-item-info"},(0,e.createElement)("div",{className:"fbdl-grid-icon"},(0,e.createElement)("img",{src:`${ae}${le[t.type]?le[t.type]:le.no_ext}`,alt:t.alt})),(0,e.createElement)("a",{rel:"noopener noreferrer",target:"_blank",href:t.link,className:"fbdl-title"},t.title),(0,e.createElement)("span",{className:"fbdl-file-size"},t.size)),(0,e.createElement)("a",{href:t.url,target:"_blank",download:!0,rel:"noopener noreferrer",className:"fbdl-download-button"},(0,X.__)("Download","filebird-dl")))))))));const{assets_icon_url:oe,type_icons:se}=fbdl;var ce=({request:t,setRequest:r,files:n})=>{const a=({type:t})=>(0,e.createElement)(e.Fragment,null);return(0,e.createElement)("div",{className:"fbdl-listview"},(0,e.createElement)("div",{className:"fbdl-listview-wrapper"},(0,e.createElement)("div",{className:"fbdl-listview-container"},(0,e.createElement)("div",{className:"fbdl-list"},(0,e.createElement)("table",{className:"fbdl-table"},(0,e.createElement)("thead",null,(0,e.createElement)("tr",null,(0,e.createElement)("th",{className:"fbdl-table-first-header"},(0,e.createElement)("div",null,(0,X.__)("File","filebird-dl"),(0,e.createElement)(a,{type:"post_title"}))),(0,e.createElement)("th",{className:"fbdl-table-header"},(0,e.createElement)("div",{className:"fbdl-table-header-wrapper"},(0,X.__)("Size","filebird-dl"),(0,e.createElement)(a,{type:"size"}))),(0,e.createElement)("th",{className:"fbdl-table-header"},(0,e.createElement)("div",{className:"fbdl-table-header-wrapper"},(0,X.__)("Type","filebird-dl"))),(0,e.createElement)("th",{className:"fbdl-table-header"},(0,e.createElement)("div",{className:"fbdl-table-header-wrapper"},(0,X.__)("Last Modified","filebird-dl"),(0,e.createElement)(a,{type:"post_modified"}))),(0,e.createElement)("th",{className:"fbdl-table-last-header"},(0,X.__)("Download","filebird-dl")))),(0,e.createElement)("tbody",null,n.map((t=>(0,e.createElement)("tr",null,(0,e.createElement)("td",{className:"fbdl-list-first-item"},(0,e.createElement)("div",{className:"fbdl-list-item-icon"},(0,e.createElement)("div",{className:"fbdl-list-item-icon-wrapper"},(0,e.createElement)("img",{src:`${oe}${se[t.type]?se[t.type]:se.no_ext}`,alt:t.alt})),(0,e.createElement)("div",{className:"fbdl-list-item-title"},(0,e.createElement)("div",null,(0,e.createElement)("a",{href:t.link,target:"_blank",rel:"noopener noreferrer"},t.title))))),(0,e.createElement)("td",{className:"fbdl-list-item"},(0,e.createElement)("div",null,t.size)),(0,e.createElement)("td",{className:"fbdl-list-item"},(0,e.createElement)("div",null,t.type?`.${t.type}`:"")),(0,e.createElement)("td",{className:"fbdl-list-item"},(0,e.createElement)("div",null,t.modified)),(0,e.createElement)("td",{className:"fbdl-list-last-item"},(0,e.createElement)("a",{href:t.url,target:"_blank",download:!0,rel:"noopener noreferrer"},(0,X.__)("Download","filebird-dl"))))))))))))};const{assets_icon_url:ue,type_icons:de}=fbdl;var fe=()=>(0,e.createElement)("div",{className:"fbdl-empty"},(0,e.createElement)("div",{className:"fbdl-empty-wrapper"},(0,e.createElement)("img",{src:`${ue}empty.svg`}),(0,e.createElement)("div",{className:"fbdl-not-found"},(0,X.__)("No attachments found.","filebird-dl"))));const me=fbdl.json_url;var pe=t=>{const r=t.loading?"fbdl-opacity-50":"";return(0,e.createElement)("div",{className:"fbdl-spinner"},t.loading&&(0,e.createElement)("div",null,(0,e.createElement)("div",{className:"fbdl-spinner-wrapper"},(0,e.createElement)("div",{className:"spin"},(0,e.createElement)("div",{className:"spinner-grow"})),(0,e.createElement)("div",{className:"fbdl-spinner-text"},"Loading..."))),(0,e.createElement)("div",{className:r},t.children))},be=({loading:t,setLoading:r,setMaxNumPages:n,setFoundPosts:a,attributes:l,request:i,setRequest:o,layout:s,setLayout:c,column:u,setColumn:d})=>{const[f,m]=(0,e.useState)([]),[p,b]=(0,e.useState)(!1);return(0,e.useEffect)((()=>{!async function(){r(!0);const e=await(async e=>{const t=await fetch(`${me}/get-attachments`,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(e)}).then((e=>{if(e.ok)return e;throw new Error((0,X.__)("Network response was not ok.","filebird-dl"))}));return await t.json()})(i);r(!1),n(e.maxNumPages),a(e.foundPosts),m(e.files)}()}),[i]),(0,e.useEffect)((()=>{c(l.layout)}),[l.layout]),(0,e.useEffect)((()=>{d(l.column)}),[l.column]),(0,e.useEffect)((()=>{b(!0)}),[]),(0,e.useEffect)((()=>{o(J(i,(e=>{e.selectedFolder=l.request.selectedFolder})))}),[l.request.selectedFolder]),(0,e.useEffect)((()=>{o(J(i,(e=>{e.pagination.limit=l.request.pagination.limit})))}),[l.request.pagination.limit]),(0,e.useEffect)((()=>{o(J(i,(e=>{e.orderBy=l.request.orderBy})))}),[l.request.orderBy]),(0,e.useEffect)((()=>{o(J(i,(e=>{e.orderType=l.request.orderType})))}),[l.request.orderType]),(0,e.createElement)(pe,{loading:t},f.length||t||!p?"grid"===s?(0,e.createElement)(ie,{files:f,column:u}):(0,e.createElement)(ce,{request:i,setRequest:o,files:f}):(0,e.createElement)(fe,null))};const _e={pagination:{current:1,limit:10},search:"",orderBy:"",orderType:"",selectedFolder:[]};var ye=r=>{const[n,a]=(0,e.useState)((e=>{const t={...e.request.pagination},r={...e.request,pagination:t};return{..._e,...r}})(r)),[l,i]=(0,e.useState)(!1),[o,s]=(0,e.useState)(0),[c,u]=(0,e.useState)(0),[d,f]=(0,e.useState)(r.layout),[m,p]=(0,e.useState)(r.column);return(0,e.createElement)(t().StrictMode,null,(0,e.createElement)(ne,{request:n,setRequest:a,attributes:r}),(0,e.createElement)(G,{request:n,setRequest:a,layout:d,setLayout:f,foundPosts:c,attributes:r}),(0,e.createElement)(be,{attributes:r,column:m,setColumn:p,layout:d,setLayout:f,request:n,setRequest:a,loading:l,setLoading:i,setMaxNumPages:s,setFoundPosts:u}),(0,e.createElement)(ee,{maxNumPages:o,foundPosts:c,request:n,setRequest:a}))};document.addEventListener("DOMContentLoaded",(function(){document.querySelectorAll(".njt-fbdl").forEach((t=>{const r=JSON.parse(t.dataset.json);a().render((0,e.createElement)(ye,{...r}),t)}))}))}()}();