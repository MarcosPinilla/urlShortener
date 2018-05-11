import ApiService from './Api.service.js'

class AcortaService extends ApiService {
  constructor (endpoint) {
    super(endpoint)
    this.name = endpoint
  }
}

export const acortaService = new AcortaService('acortar')
