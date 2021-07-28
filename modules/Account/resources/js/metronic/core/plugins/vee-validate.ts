import {configure} from 'vee-validate'
import {setLocale} from 'yup'

export function initVeeValidate() {
  configure({
    validateOnBlur: false,
    validateOnChange: true,
    validateOnModelUpdate: false
  })
}

setLocale({
  mixed: {
    'alpha': 'Поле ${path} может содержать только буквы',
    'alpha_dash': 'Поле ${path} может содержать только буквы, цифры и дефис',
    'alpha_num': 'Поле ${path} может содержать только буквы и цифры',
    'alpha_spaces': 'Поле ${path} может содержать только буквы и пробелы',
    'between': 'Поле ${path} должно быть между ${min} и ${max}',
    'confirmed': 'Поле ${path} не совпадает Подтверждение',
    'digits': 'Поле ${path} должно быть числовым и точно содержать ${length} цифры',
    'dimensions': 'Поле ${path} должно быть 0:{width} пикселей на 1:{height} пикселей',
    'email': 'Поле ${path} должно быть действительным электронным адресом',
    'excluded': 'Поле ${path} должно быть допустимым значением',
    'ext': 'Поле ${path} должно быть действительным файлом. ({args})',
    'image': 'Поле ${path} должно быть изображением',
    'one_of': 'Поле ${path} должно быть допустимым значением',
    'integer': 'Поле ${path} должно быть целым числом',
    'length': 'Длина поля ${path} должна быть ${length}',
    'max': 'Поле ${path} не может быть более ${length} символов',
    'max_value': 'Поле ${path} должно быть ${max} или менее',
    'mimes': 'Поле ${path} должно иметь допустимый тип файла. ({args})',
    'min': 'Поле ${path} должно быть не менее ${length} символов',
    'min_value': 'Поле ${path} должно быть ${min} или больше',
    'numeric': 'Поле ${path} должно быть числом',
    'regex': 'Поле ${path} имеет ошибочный формат',
    'required': 'Поле ${path} обязательно для заполнения',
    'required_if': 'Поле ${path} обязательно для заполнения',
    'size': 'Поле ${path} должно быть меньше, чем 0:{size}KB',
  },
  string:{
    'email': 'Поле ${path} должно быть действительным электронным адресом',
  }
})
