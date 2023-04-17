moment.locale("pt-br");

//-- jQuery - Plugins customizados:
$.fn.scrollBy = function (x, y) {
  return this.animate({
    scrollLeft: "+=" + x,
    scrollTop: "+=" + y,
  });
};

$.ajaxSetup({
  error: ajaxError,
});

$(document).ajaxSend(function (event, request, settings) {
  let prevNonce = $("script")[0].nonce;
  if (settings.type == "POST") {
    if (typeof settings.data === "string") {
      //-- Em requisições POST acrescenta o token CSRF
      if (settings.data.indexOf("&csrf_token=") === -1) {
        settings.data += "&csrf_token=" + $("body").data("reqid");
      }
      //-- Nas demais requisições acrescenta o pega bot
      if ($('input[name="_pooh"]').length > 0) {
        if (settings.data.indexOf("&_pooh=") === -1) {
          settings.data += "&_pooh=" + $('input[name="_pooh"]').val();
        }
      }
      settings.data += "&_prevn=" + prevNonce;
    } else if (typeof settings.data === "undefined") {
      //-- Define o data como FormData caso ele não exista
      settings.data = new FormData();
      //-- Em requisições POST acrescenta o token CSRF
      if (settings.data.get("csrf_token") === null) {
        settings.data.append("csrf_token", $("body").data("reqid"));
      }
      settings.data.append("_prevn", prevNonce);
    } else {
      //-- Em requisições POST acrescenta o token CSRF
      if (settings.data.get("csrf_token") === null) {
        settings.data.append("csrf_token", $("body").data("reqid"));
      }
      settings.data.append("_prevn", prevNonce);
    }
  }
});

/**
 * Embaralha um array
 * @param {*} array
 */
function arrayShuffle(array) {
  var currentIndex = array.length,
    temporaryValue,
    randomIndex;
  while (0 !== currentIndex) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }
  return array;
}

//-- Converte um número para float
function toFloat(number) {
  number = ("0" + number).match(/(\d|,|\.)/g).join("");
  if (number.indexOf(",") >= 0) {
    return parseFloat((number + "").replace(/\./g, "").replace(",", "."));
  } else {
    return parseFloat(number);
  }
}

//-- Converte um número para inteiro
function toInt(number) {
  return parseInt(toDecimal("0" + number, 0));
}

//-- Converte um numero para String decimal
function toDecimal(number, decimais) {
  if (decimais > 0) {
    return toFloat(number)
      .toFixed(decimais || 2)
      .replace(".", ",");
  } else {
    return parseInt(toFloat(number).toFixed(0)) + "";
  }
}

//-- Retorna um Parse de string json ou um valor padrão definido
function parseJson(str, std) {
  var ret;
  if (typeof str === "object") return str;
  try {
    ret = JSON.parse(str);
  } catch (ex) {
    ret = std !== undefined ? std : {};
  }
  return ret;
}

//-- Retorna um Parse de string jwt ou um valor padrão definido
function parseJwt(jwtToken) {
  try {
    return JSON.parse(atob(jwtToken.split(".")[1]));
  } catch (e) {
    return null;
  }
}

//-- Remove acentos de uma dada string
function removerAcentos(newStringComAcento) {
  var string = newStringComAcento;
  var mapaAcentosHex = {
    a: /[\xE0-\xE6]/g,
    e: /[\xE8-\xEB]/g,
    i: /[\xEC-\xEF]/g,
    o: /[\xF2-\xF6]/g,
    u: /[\xF9-\xFC]/g,
    c: /\xE7/g,
    n: /\xF1/g,
  };

  for (var letra in mapaAcentosHex) {
    var expressaoRegular = mapaAcentosHex[letra];
    string = string.replace(expressaoRegular, letra);
  }

  return string;
}

/**
 * Remoção de caracteres especiais de uma dada string
 *
 * @param {string} newStringComCaracteres
 * @return {string} [description]
 */
function removeSpecialCharacters(newStringComCaracteres) {
  var string = newStringComCaracteres
    .normalize("NFD")
    .replace(/([\u0300-\u036f]|[^0-9a-zA-Z])/g, "");
  return string;
}

/**
 * Função que retorna uma lista de meses por extenso
 * @return {[type]} [description]
 */
function mesesExtenso(modo) {
  modo = typeof modo === "undefined" ? "full" : modo;
  var meses = {
    full: [
      "Janeiro",
      "Fevereiro",
      "Março",
      "Abril",
      "Maio",
      "Junho",
      "Julho",
      "Agosto",
      "Setembro",
      "Outubro",
      "Novembro",
      "Dezembro",
    ],
    short: [
      "Jan",
      "Fev",
      "Mar",
      "Abr",
      "Mai",
      "Jun",
      "Jul",
      "Ago",
      "Set",
      "Out",
      "Nov",
      "Dez",
    ],
  };
  return typeof meses[modo] !== "undefined" ? meses[modo] : [];
}

/**
 * Recebe um Input HTML nativo para que seja copiado.
 *
 * @param {*} el
 */
function copiarClipboard(el) {
  let $el = $(el)[0],
    tof = false,
    tipo = $el.type;

  $el.type = "text";
  $el.focus();
  $el.setSelectionRange(0, $el.value.length);
  try {
    tof = document.execCommand("copy");
  } catch (e) {
    tof = false;
  }
  $el.type = tipo;
  return tof;
}

/**
 * Consulta se um dado item de ação está processando
 * @param {*} $obj
 * @returns
 */
function btnLoadChk($obj) {
  return $obj.data("loading") == "S";
}

/**
 * Informa que um dado item de ação está processando
 * @param {*} $obj
 */
function btnLoadAdd($obj, selector) {
  selector = selector || "";
  $obj.addClass("disabled");
  $obj.data("loading", "S");
  if (selector != "") {
    loadingAdd(selector);
  }
}

/**
 * Informa que um dado item de ação terminou o processamento (delay por segurança contra duplo clique)
 * @param {*} $obj
 */
function btnLoadDel($obj, selector) {
  selector = selector || "";
  setTimeout(function () {
    $obj.removeClass("disabled");
    $obj.data("loading", "N");
  }, 500);
  if (selector != "") {
    loadingDel(selector);
  }
}

/**
 * Validação de força de senha
 * @param {*} objTarget
 * @param {*} password
 * @returns
 */
function passwordStrength(objTarget, password) {
  var desc = [
    {
      width: "5%",
    },
    {
      width: "25%",
    },
    {
      width: "50%",
    },
    {
      width: "75%",
    },
    {
      width: "100%",
    },
    {
      width: "100%",
    },
  ];

  var descClass = [
    "bg-danger",
    "bg-danger",
    "bg-warning",
    "bg-info",
    "bg-success",
    "bg-success",
  ];

  var score = 0;

  //if password bigger than 7 give 1 point
  if (password.length > 7) score++;

  //if password has both lower and uppercase characters give 1 point
  if (password.match(/[a-z]/) && password.match(/[A-Z]/)) score++;

  //if password has at least one number give 1 point
  if (password.match(/\d+/)) score++;

  //if password has at least one special caracther give 1 point
  if (password.match(/[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) score++;

  //if password bigger than 12 give another 1 point
  if (password.length > 10) score++;

  // display indicator
  $(objTarget)
    .removeClass(descClass.join(" "))
    .addClass(descClass[score])
    .css(desc[score]);
  return score;
}

/**
 * Validação de CPF
 * @param {*} cpf
 * @returns
 */
function validarCPF(cpf) {
  // Remove caracteres especiais do campo
  var cpf = removeSpecialCharacters(cpf);

  // Verifica se o campo esta vazio
  if (cpf == "") return false;

  // Elimina CPFs invalidos conhecidos
  if (
    cpf == "00000000000" ||
    cpf == "11111111111" ||
    cpf == "22222222222" ||
    cpf == "33333333333" ||
    cpf == "44444444444" ||
    cpf == "55555555555" ||
    cpf == "66666666666" ||
    cpf == "77777777777" ||
    cpf == "88888888888" ||
    cpf == "99999999999"
  ) {
    return false;
  }

  // Valida 1o digito
  add = 0;
  for (i = 0; i < 9; i++) add += toInt(cpf.charAt(i)) * (10 - i);
  rev = 11 - (add % 11);
  if (rev == 10 || rev == 11) rev = 0;
  if (rev != toInt(cpf.charAt(9))) return false;

  // Valida 2o digito
  add = 0;
  for (i = 0; i < 10; i++) add += toInt(cpf.charAt(i)) * (11 - i);
  rev = 11 - (add % 11);
  if (rev == 10 || rev == 11) rev = 0;
  if (rev != toInt(cpf.charAt(10))) return false;

  return true;
}

/**
 * Validação de CNPJ
 * @param {*} cnpj
 * @returns
 */
function validarCNPJ(cnpj) {
  // Remove caracteres especiais do campo
  var cnpj = removeSpecialCharacters(cnpj);

  // Verifica se o campo esta vazio
  if (cnpj == "") return false;

  if (cnpj.length != 14) return false;

  // Elimina CPFs invalidos conhecidos
  if (
    cnpj == "00000000000" ||
    cnpj == "11111111111" ||
    cnpj == "22222222222" ||
    cnpj == "33333333333" ||
    cnpj == "44444444444" ||
    cnpj == "55555555555" ||
    cnpj == "66666666666" ||
    cnpj == "77777777777" ||
    cnpj == "88888888888" ||
    cnpj == "99999999999"
  ) {
    return false;
  }

  // Valida DVs
  tamanho = cnpj.length - 2;
  numeros = cnpj.substring(0, tamanho);
  digitos = cnpj.substring(tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
  if (resultado != digitos.charAt(0)) return false;

  tamanho = tamanho + 1;
  numeros = cnpj.substring(0, tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
  if (resultado != digitos.charAt(1)) return false;

  return true;
}

/**
 * Busca uma chave no localStorage
 * @param {*} chave
 * @param {*} valorPadrao
 * @returns
 */
function getLStorage(chave, valorPadrao) {
  var dados = localStorage.getItem(chave);
  valorPadrao = valorPadrao || false;
  if (dados === null) {
    return valorPadrao;
  }
  return dados;
}

/**
 * Define uma chave no localStorage
 * @param {*} chave
 * @param {*} valor
 */
function setLStorage(chave, valor) {
  localStorage.setItem(chave, valor);
}

/**
 * Validar email
 * @param {string} email
 * @return {bool}
 */
function validateEmail(email) {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

/**
 * Conversão de valores numéricos
 *
 * @param {*} valor
 * @param {*} moeda
 * @param {*} advOpt Objeto de extensão de propriedades Intl
 * @returns
 */
function toMoney(valor, moeda, advOpt) {
  let opt = Object.assign(
    {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    },
    advOpt || {}
  );
  moeda = moeda || false;
  if (moeda) {
    opt.style = "currency";
    opt.currency = "BRL";
  }
  return Intl.NumberFormat("pt-br", opt).format(toFloat(valor));
}

/**
 * Mascara um dado valor
 * @param {*} valor
 * @param {*} mascara
 * @param {*} reversa
 */
function quickMask(valor, mascara, reversa) {
  reversa = typeof reversa === "undefined" ? true : reversa === true;
  return $(`<div>${valor}</div>`)
    .mask(mascara, {
      reverse: reversa,
    })
    .text();
}

function cpfcnpjMask(value) {
  let cnpjCpf = value.replace(/\D/g, "");
  if (cnpjCpf.length === 11) {
    return quickMask(value, "999.999.999-99", false);
  }
  return quickMask(value, "99.999.999/9999-99", false);
}

/**
 * Verifica se o valor passado está vazio
 * @param {*} value
 * @returns
 */
function isEmpty(value) {
  switch (typeof value) {
    case "undefined":
      return true;
    case "Object":
    case "object":
      if (typeof value.length === "undefined") {
        if (Object.keys(value).length === 0) {
          return true;
        }
        return false;
      }
      return value.length > 0;
    case "boolean":
      return value;
    case "number":
      return value === 0;
    case "string":
      if (("" + value).trim() === "") {
        return true;
      }
      break;
    case "symbol":
      return false;
    case "function":
      return false;
  }

  return false;
}

/**
 * Gera o toggler de senha
 * @param {*} seletor
 */
function createPasswordToggler(seletor) {
  let $obj = $(seletor);
  $obj.on("click", function () {
    let $this = $(this),
      $ipt = $this.parent().find("input");
    if ($ipt.attr("type") === "password") {
      $this.removeClass("fa-eye-slash").addClass("fa-eye");
      $ipt.attr("type", "text");
    } else {
      $this.removeClass("fa-eye").addClass("fa-eye-slash");
      $ipt.attr("type", "password");
    }
  });
}

/**
 * Emite um ajax com propriedades para envio de arquivo.
 * Converte um json para formData
 * @param {*} options
 * @returns
 */
function ajaxFile(options) {
  let defaultOptions = Object.assign(
    {
      method: "post",
      contentType: false,
      data: {},
      processData: false,
      success: function (ret) {
        return alert(ret);
      },
      error: ajaxError,
    },
    options
  );
  if (typeof defaultOptions.data.append === "undefined") {
    let fData = new FormData();
    for (let key in defaultOptions.data) {
      fData.append(key, defaultOptions.data[key]);
    }
    defaultOptions.data = fData;
  }
  return $.ajax(defaultOptions);
}

/**
 * Tratamento de erros ajax
 * @param {*} err
 * @returns
 */
function ajaxError(err) {
  let msg = [];
  if (typeof err.responseJSON !== "undefined") {
    if (typeof err.responseJSON.messages !== "undefined") {
      for (let x in err.responseJSON.messages) {
        msg.push(err.responseJSON.messages[x]);
      }
    } else {
      msg.push("Falha na resposta do servidor!");
    }
  } else if (typeof err.messages !== "undefined") {
    for (let x in err.messages) {
      msg.push(err.messages[x]);
    }
  } else if (
    typeof err.status !== "undefined" &&
    err.status >= 200 &&
    err.status < 300
  ) {
    // Sem erro falso positivo
    return "";
  } else {
    msg.push("Falha na comunicação com servidor!");
  }
  return alert(msg.join("\n"));
}

/**
 * Abre compartilhamento com aplicativo
 * {title, text, url}
 * @param {*} info
 * @param {*} cbSuccess
 * @param {*} cbError
 * @returns
 */
function mobileShare(info, cbSuccess, cbError) {
  if (!("share" in navigator)) {
    alert("Navegador sem suporte para compartilhamento!");
    return;
  }

  return navigator
    .share(info)
    .then(() => cbSuccess || console.log("Successful share"))
    .catch((error) => cbError || console.log("Error sharing:", error));
}

/**
 * Pesquisa padrão para ocultar elementos em tela.
 *
 * @param {*} objInput
 * @param {*} objPesquisa
 */
function pesquisaPadrao(objInput, objPesquisa) {
  var $objInput = $(objInput);
  $objInput.on("keyup", function () {
    var termo = tratarTermoPesquisa($objInput.val());
    $(objPesquisa).each(function () {
      var $this = $(this),
        alvo = tratarTermoPesquisa($this.text());
      if (termo === "" || alvo.indexOf(termo) !== -1) {
        $this.show();
      } else {
        $this.hide();
      }
    });
  });
}

/**
 * Trata um termo de pesquisa
 * @param {*} valor
 */
function tratarTermoPesquisa(valor) {
  return removerAcentos(("" + valor).trim().toLowerCase())
    .replace(/(?:\r\n|\r|\n)/g, " ")
    .replace(/(?:\r\n|\r|\n)/g, " ");
}

/**
 * Função de compressão de imagem pelo frontend.
 *
 * @param file Arquivo do input
 * @param callback Função de callback
 */
async function compressImage(file, callback) {
  var options = {
    maxSizeMB: 1,
    maxWidthOrHeight: 1920,
    useWebWorker: false,
  };
  const output = await imageCompression(file, options);
  return callback(output);
}

/*
 * Comprime uma imagem de um dado campo de arquivo e salva no atributo data-compressed
 * @param {*} obj
 */
function compressImageFile(obj) {
  let ext = obj.files[0].name.split(".").pop().toLowerCase();
  if (ext.indexOf("png", "jpg", "jpeg") === -1) {
    compressImage(obj.files[0], function (file) {
      $(obj).data("compressed", file);
    });
  }
}

/**
 * Envio de notificações
 */
function LocalNotification() {
  var ln = this;

  /**
   * Cria a notificação
   *
   * @param {*} title
   * @param {*} body
   * @param {*} icon
   * @param {*} tag
   * @param {*} data
   */
  ln.sendNotification = function (title, body, icon, tag, data) {
    if (ln.isSupported() === false || ln.isPermissionGranted() === false) {
      return ln.requestPermission();
    }
    return new Notification(title, {
      body,
      icon,
      tag,
      data,
    });
  };

  /**
   * Verifica se as notificações são suportadas
   * @returns
   */
  ln.isSupported = function () {
    return "Notification" in window;
  };

  /**
   * Solicita permissão de notificações
   *
   * @returns
   */
  ln.requestPermission = function () {
    return Notification.requestPermission();
  };

  /**
   * Verifica se a permissão foi concedida
   *
   * @returns boolean
   */
  ln.isPermissionGranted = function () {
    return Notification.permission === "granted";
  };

  //-- Solicita permissão de notificações no momento de inicialização
  ln.init = function () {
    if (ln.isSupported() && ln.isPermissionGranted() === false) {
      ln.requestPermission();
    }
  };

  ln.init();
}

/**
 * Contador no ícone do app
 */
function AppBadges() {
  var b = this;

  b.isSupported = function () {
    return "setAppBadge" in navigator;
  };

  b.setCount = function (count) {
    if (b.isSupported()) {
      navigator.setAppBadge(count);
    }
  };

  b.clear = function () {
    if (b.isSupported()) {
      navigator.clearAppBadge();
    }
  };
}

/**
 * Mensagens de alerta
 */
function toast(msg, type) {
  let $cont = $(".toastContainer");
  if ($cont.length === 0) {
    $cont = $('<div class="toastContainer"></div>');
    $("body").append($cont);
  }
  let $toast = $('<div class="toastItem alert animated fadeInRight"></div>');
  $toast.addClass("alert-" + (type || "success"));
  $toast.html(msg);
  $toast.appendTo(".toastContainer");
  setTimeout(function () {
    $toast.addClass("fadeOutRight");
    setTimeout(function () {
      $toast.remove();
    }, 500);
  }, 4500);
}

/**
 * Adição de loading
 * @param {*} selector
 * @param {*} count
 */
function loadingAdd(selector) {
  let $loader = $(
    `<loader class="loadingContainer animated fadeIn ${
      selector || "loadingDefault"
    }"><span class="fas fa-sync fa-spin"></span></loader>`
  );
  $("body").append($loader);
}

/**
 * Remoção de loading
 * @param {*} selector
 */
function loadingDel(selector) {
  selector = selector || "loadingDefault";
  if (selector != "") {
    selector = selector[0] == "." ? selector : "." + selector;
  }
  let seletor = ".loadingContainer" + selector;
  let $obj = $(seletor);
  if ($obj.length > 0) {
    setTimeout(function () {
      $obj.removeClass("fadeIn").addClass("fadeOut");
      setTimeout(function () {
        $obj.remove();
      }, 250);
    }, 500);
  }
}

/**
 * Função de autosave de um campo padrão do sistema
 * - Deve-se passar a referencia do campo (id, classe ou nome do elemento) e a rota backend que executa o autosave do campo
 * - Garantir que o elemento passado tenha como classe autosave
 * - Os valores enviados para o backend por Ajax são: 'Id do campo', 'Value do campo'
 *
 * @param {string} cam
 * @param {string} url
 */
function autosaveCam(cam, url) {
  /**
   * Função de timer para campo
   *
   * @param {*} f
   * @param {*} delay
   * @returns
   */
  throttle = function (f, delay) {
    var timer = null;
    return function () {
      var context = this,
        args = arguments;
      clearTimeout(timer);
      timer = window.setTimeout(function () {
        f.apply(context, args);
      }, delay || 2000);
    };
  };

  /**
   * Função de autoSave de campo
   *
   * @param {*} e
   */
  autoTextSave = function (e) {
    $.ajax({
      url: url,
      type: "POST",
      data: {
        cam: e.target.id,
        value: e.target.value,
      },
      error: ajaxError,
    });
  };

  /**
   * Evento jQuery de execução da função
   */
  $(cam + ".autosave").keyup(
    throttle(function (e) {
      autoTextSave(e);
    })
  );
}

/**
 * Function to check if is mobile
 *
 * @returns
 */
function isMobile() {
  let check = false;
  (function (a) {
    if (
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(
        a
      ) ||
      /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
        a.substr(0, 4)
      )
    )
      check = true;
  })(navigator.userAgent || navigator.vendor || window.opera);
  return check;
}

/**
 * Tratamento de datas
 * @param {*} orgVal
 * @param {*} orgFormat
 * @param {*} tgtFormat
 * @returns
 */
function getSafeDate(orgVal, orgFormat, tgtFormat) {
  let date = moment(orgVal, orgFormat);
  if (date.isValid() === false) {
    return "";
  }
  return date.format(orgFormat) == orgVal ? date.format(tgtFormat) : "";
}

/**
 *
 * @param {*} permission
 */
function checkPermission(permission) {
  // Check if the browser supports the Permissions API
  if ("permissions" in navigator) {
    // Check the current state of the requested permission
    navigator.permissions
      .query({ name: permission })
      .then(function (permissionStatus) {
        // Check if the permission was granted
        if (permissionStatus.state === "granted") {
          console.log(`Permission ${permission} was granted.`);
          return true;
        } else {
          console.log(`Permission ${permission} was not granted.`);
          return false;
        }
      });
  } else {
    console.log("Your browser doesn't support Permissions API");
    return false;
  }
}
