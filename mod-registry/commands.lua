function tokenize(mystring)
	s={}
	for x in mystring:gmatch("[^%s]+") do
		s[#s+1] = x ; print (#s)
	end
	return s
end

-- Forcefully unregister a player
minetest.register_chatcommand('unregister', {
	params = '<name>',
	description = '',
	privs = {registrar=true},
	func = function(playername, cstring)
		local params = tokenize(cstring)

		local res = pregistry:unregister(params[1])
		minetest.chat_send_player(playername, res)
	end,
})

-- Run ban routine
-- TODO integrate xban ?
minetest.register_chatcommand('ban', {
	params = '<name>',
	description = '',
	privs = {registrar=true},
	func = function(playername, cstring)
		local params = tokenize(cstring)

		local res = pregistry:ban(params[1])
		minetest.chat_send_player(playername, res)
	end,
})

-- Unban a player
-- TODO integrate with xban ?
minetest.register_chatcommand('unban', {
	params = '<name>',
	description = '',
	privs = {registrar=true},
	func = function(playername, cstring)
		local params = tokenize(cstring)

		local res = pregistry:unban(params[1])
		minetest.chat_send_player(playername, res)
	end,
})

minetest.register_chatcommand('isbanned', {
	params = '<name>',
	description = '',
	privs = {registrar=true},
	func = function(playername, cstring)
		local params = tokenize(cstring)

		local res = pregistry:isbanned(params) -- FIXME old code
		minetest.chat_send_player(playername, res)
	end,
})



