import users from '@/data/users.json'

export function ajaxFindUser (query) {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      const results = users.find(user => user.id === query)
      resolve(results)
    }, 1000)
  })
}
